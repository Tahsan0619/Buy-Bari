<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use RuntimeException;

class NittozImporter
{
    public function __construct(private NittozClient $client, private NittozMapper $mapper) {}

    /**
     * @param  array<string, mixed>  $mapped
     */
    public function importMapped(array $mapped, ?int $categoryId = null): Product
    {
        $remoteId = $mapped['b_product_id'] ?? null;
        if ($remoteId && Product::query()->where('b_product_id', $remoteId)->exists()) {
            throw new RuntimeException('Product '.$remoteId.' is already in the shop, so it was not added again.');
        }

        $category = $categoryId
            ? Category::query()->findOrFail($categoryId)
            : Category::query()->firstOrCreate(
                ['slug' => Str::slug($mapped['category'] ?: 'imported')],
                ['name' => $mapped['category'] ?: 'Imported', 'icon' => 'grid', 'sort' => 99]
            );

        return Product::query()->create([
            'b_product_id' => $remoteId,
            'category_id' => $category->id,
            'name' => $mapped['name'],
            'slug' => $this->slug($mapped['name'], $remoteId),
            'image' => $mapped['image'] ?: null,
            'price' => max(0, (int) $mapped['price']),
            'old_price' => max(0, (int) ($mapped['old_price'] ?? 0)),
            'description' => $mapped['description'] ?? '',
            'section' => 'new',
            'badge' => 'new',
            'rating' => 5,
            'reviews' => 0,
            'is_variable' => (bool) ($mapped['is_variable'] ?? false),
            'variants' => array_values($mapped['variants'] ?? []),
            'raw' => $mapped['raw'] ?? null,
            'is_active' => true,
            'synced_at' => now(),
        ]);
    }

    /**
     * Pull every product the Nittoz dropshipper catalog exposes (all pages).
     *
     * @return array{added: int, updated: int, skipped: int, failed: list<string>, categories: int, pages: int, api_total: int, shop_total: int}
     */
    public function syncAll(): array
    {
        $categoriesSynced = $this->syncCategories();
        $perPage = max(1, min(200, (int) config('nittoz.per_page', 100)));
        $page = 1;
        $pages = 0;
        $added = 0;
        $updated = 0;
        $skipped = 0;
        $failed = [];
        $apiTotal = 0;
        $totalPages = null;
        $seenIds = [];

        do {
            $list = $this->client->products([
                'page' => $page,
                'per_page' => $perPage,
            ]);
            $data = is_array($list['data'] ?? null) ? $list['data'] : $list;
            $rows = $data['products'] ?? $list['products'] ?? [];
            $pagination = is_array($data['pagination'] ?? null) ? $data['pagination'] : [];
            $apiTotal = (int) ($pagination['total'] ?? $apiTotal);
            $totalPages = isset($pagination['total_pages']) ? (int) $pagination['total_pages'] : $totalPages;
            $hasMore = (bool) ($pagination['has_more'] ?? false);
            $currentPage = (int) ($pagination['current_page'] ?? $page);

            if (! is_array($rows)) {
                throw new RuntimeException('Nittoz did not return a product list.');
            }

            $pages++;
            foreach ($rows as $row) {
                if (! is_array($row) || empty($row['id'])) {
                    continue;
                }
                $remoteId = (int) $row['id'];
                $seenIds[$remoteId] = true;
                try {
                    $source = $row;
                    $needsDetail = (bool) ($row['has_variants'] ?? false)
                        || (int) ($row['is_variable'] ?? 0) === 1
                        || empty($row['description']);
                    if ($needsDetail) {
                        usleep(150_000);
                        $detail = $this->client->product($row['id']);
                        $payload = is_array($detail['data'] ?? null) ? $detail['data'] : $detail;
                        $source = is_array($payload['product'] ?? null) ? $payload['product'] : $row;
                    }
                    $result = $this->upsertMapped($this->mapper->map($source));
                    if ($result === 'added') {
                        $added++;
                    } elseif ($result === 'updated') {
                        $updated++;
                    } else {
                        $skipped++;
                    }
                } catch (RuntimeException $e) {
                    $failed[] = '#'.$row['id'].': '.$e->getMessage();
                }
            }

            $page++;
            if ($rows === [] || $page > 500) {
                break;
            }
            if ($totalPages !== null && $currentPage >= $totalPages) {
                break;
            }
            if ($totalPages === null && ! $hasMore) {
                break;
            }
        } while (true);

        return [
            'added' => $added,
            'updated' => $updated,
            'skipped' => $skipped,
            'failed' => $failed,
            'categories' => $categoriesSynced,
            'pages' => $pages,
            'api_total' => $apiTotal ?: count($seenIds),
            'shop_total' => Product::query()->whereNotNull('b_product_id')->count(),
        ];
    }

    /**
     * @param  array<string, mixed>  $mapped
     * @return 'added'|'updated'
     */
    public function upsertMapped(array $mapped, ?int $categoryId = null): string
    {
        $remoteId = $mapped['b_product_id'] ?? null;
        $existing = $remoteId
            ? Product::query()->where('b_product_id', $remoteId)->first()
            : null;

        $category = $categoryId
            ? Category::query()->findOrFail($categoryId)
            : Category::query()->firstOrCreate(
                ['slug' => Str::slug($mapped['category'] ?: 'imported')],
                ['name' => $mapped['category'] ?: 'Imported', 'icon' => 'grid', 'sort' => 99]
            );

        $attrs = [
            'category_id' => $category->id,
            'name' => $mapped['name'],
            'image' => $mapped['image'] ?: null,
            'price' => max(0, (int) $mapped['price']),
            'old_price' => max(0, (int) ($mapped['old_price'] ?? 0)),
            'description' => $mapped['description'] ?? '',
            'is_variable' => (bool) ($mapped['is_variable'] ?? false),
            'variants' => array_values($mapped['variants'] ?? []),
            'raw' => $mapped['raw'] ?? null,
            'is_active' => true,
            'synced_at' => now(),
        ];

        if ($existing) {
            $existing->fill($attrs)->save();

            return 'updated';
        }

        Product::query()->create([
            ...$attrs,
            'b_product_id' => $remoteId,
            'slug' => $this->slug($mapped['name'], $remoteId),
            'section' => 'new',
            'badge' => 'new',
            'rating' => 5,
            'reviews' => 0,
        ]);

        return 'added';
    }

    public function syncCategories(): int
    {
        $response = $this->client->categories();
        $rows = $response['data'] ?? $response['categories'] ?? [];
        if (! is_array($rows)) {
            return 0;
        }

        $count = 0;
        foreach ($rows as $index => $row) {
            if (! is_array($row) || empty($row['name'])) {
                continue;
            }
            $name = (string) $row['name'];
            $slug = Str::slug((string) ($row['slug'] ?? $name)) ?: 'category-'.($row['id'] ?? $index);
            Category::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'icon' => 'grid',
                    'sort' => (int) ($row['position'] ?? ($index + 1)),
                ]
            );
            $count++;
        }

        return $count;
    }

    private function slug(string $name, ?int $remoteId): string
    {
        $base = Str::slug($name) ?: 'product';
        $slug = $remoteId ? $base.'-'.$remoteId : $base;
        $i = 2;
        while (Product::query()->where('slug', $slug)->exists()) {
            $slug = $base.'-'.($remoteId ?: $i);
            $i++;
            if ($i > 50) {
                $slug = $base.'-'.Str::lower(Str::random(4));
                break;
            }
        }

        return $slug;
    }
}

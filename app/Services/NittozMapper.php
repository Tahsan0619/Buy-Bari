<?php

namespace App\Services;

use App\Models\CatalogPath;

class NittozMapper
{
    /**
     * @param  array<string, mixed>  $product
     * @return array{
     *     b_product_id: ?int,
     *     name: string,
     *     price: int,
     *     old_price: int,
     *     wholesale_price: int,
     *     description: string,
     *     image: string,
     *     is_variable: bool,
     *     variants: list<array{sku: string, color: string, size: string, price: int, image: string}>,
     *     category: string,
     *     raw: array<string, mixed>
     * }
     */
    public function map(array $product, string $imagePath = ''): array
    {
        $variants = $this->variants($product, $imagePath);
        $isVariable = (bool) ($product['has_variants'] ?? false)
            || (int) ($product['is_variable'] ?? 0) === 1
            || count($variants) > 0;

        $regular = (int) ($product['regular_price'] ?? $product['price'] ?? $product['sale_price'] ?? 0);
        if ($regular <= 0 && isset($product['price_range']['min'])) {
            $regular = (int) $product['price_range']['min'];
        }
        if ($regular <= 0 && $variants !== []) {
            $regular = (int) $variants[0]['price'];
        }

        $wholesale = (int) ($product['wholesale_price'] ?? 0);
        $description = (string) ($product['description'] ?? $product['short_description'] ?? '');
        $image = (string) ($product['thumbnail'] ?? $product['image'] ?? ($variants[0]['image'] ?? ''));

        return [
            'b_product_id' => isset($product['id']) ? (int) $product['id'] : null,
            'name' => (string) ($product['name'] ?? $product['title'] ?? ('Nittoz product '.($product['id'] ?? ''))),
            'price' => $regular,
            'old_price' => (int) ($product['old_price'] ?? $product['mrp'] ?? 0),
            'wholesale_price' => $wholesale,
            'description' => trim(html_entity_decode(strip_tags($description))),
            'image' => $this->image($image, $imagePath),
            'is_variable' => $isVariable,
            'variants' => $variants,
            'category' => $this->categoryName($product),
            'raw' => $product,
        ];
    }

    /**
     * @param  array<string, mixed>  $product
     * @return list<array{sku: string, color: string, size: string, price: int, image: string}>
     */
    private function variants(array $product, string $imagePath): array
    {
        $out = [];

        // New v1 shape: variants[].values[] with sku / regular_price / key
        if (is_array($product['variants'] ?? null)) {
            foreach ($product['variants'] as $group) {
                if (! is_array($group)) {
                    continue;
                }
                $groupName = (string) ($group['name'] ?? '');
                $values = $group['values'] ?? null;
                if (! is_array($values)) {
                    // Legacy flat variant row
                    $out[] = $this->variantRow($group, $groupName, $imagePath, $product);

                    continue;
                }
                foreach ($values as $value) {
                    if (! is_array($value)) {
                        continue;
                    }
                    $out[] = $this->variantRow($value, $groupName, $imagePath, $product);
                }
            }
        }

        // Older product_images arrays
        if ($out === [] && is_array($product['product_images'] ?? null)) {
            foreach ($product['product_images'] as $image) {
                if (is_array($image)) {
                    $out[] = $this->variantRow($image, '', $imagePath, $product);
                }
            }
        }

        return array_values(array_filter($out, fn (array $row) => $row['sku'] !== '' || $row['price'] > 0 || $row['size'] !== ''));
    }

    /**
     * @param  array<string, mixed>  $row
     * @param  array<string, mixed>  $product
     * @return array{sku: string, color: string, size: string, price: int, image: string}
     */
    private function variantRow(array $row, string $groupName, string $imagePath, array $product): array
    {
        $size = (string) ($row['key'] ?? $row['size'] ?? $row['name'] ?? '');
        $color = (string) ($row['color'] ?? ($groupName !== '' && $size === '' ? $groupName : ''));
        if ($color === '' && $groupName !== '' && ! str_contains(strtolower($groupName), 'age')) {
            $color = $groupName;
        }

        return [
            'sku' => (string) ($row['sku'] ?? $row['variant_sku'] ?? ''),
            'color' => $color,
            'size' => $size,
            'price' => (int) ($row['regular_price'] ?? $row['price'] ?? $product['regular_price'] ?? $product['price'] ?? 0),
            'image' => $this->image((string) ($row['image'] ?? ''), $imagePath),
        ];
    }

    /**
     * @param  array<string, mixed>  $product
     */
    private function categoryName(array $product): string
    {
        $category = $product['category_name'] ?? $product['category'] ?? null;
        if (is_array($category)) {
            $category = $category['name'] ?? null;
        }
        $category = trim((string) $category);

        return $category !== '' ? $category : 'Imported';
    }

    private function image(string $image, string $imagePath): string
    {
        $image = trim($image);
        if ($image === '') {
            return '';
        }
        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://') || str_starts_with($image, '/')) {
            return CatalogPath::url($image);
        }
        $imagePath = trim($imagePath);
        if ($imagePath !== '') {
            return rtrim($imagePath, '/').'/'.ltrim($image, '/');
        }

        return CatalogPath::url($image);
    }
}

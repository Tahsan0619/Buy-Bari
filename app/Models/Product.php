<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'b_product_id', 'category_id', 'name', 'slug', 'image', 'price', 'old_price',
    'description', 'section', 'badge', 'rating', 'reviews', 'is_variable',
    'variants', 'raw', 'is_active', 'synced_at',
])]
class Product extends Model
{
    protected function casts(): array
    {
        return [
            'is_variable' => 'boolean',
            'is_active' => 'boolean',
            'variants' => 'array',
            'raw' => 'array',
            'synced_at' => 'datetime',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function imageUrl(): string
    {
        return CatalogPath::url($this->image);
    }

    public function unitPrice(?string $sku = null): int
    {
        if ($sku) {
            foreach ($this->variants ?? [] as $variant) {
                if ((string) ($variant['sku'] ?? '') === $sku && (int) ($variant['price'] ?? 0) > 0) {
                    return (int) $variant['price'];
                }
            }
        }

        return (int) $this->price;
    }
}

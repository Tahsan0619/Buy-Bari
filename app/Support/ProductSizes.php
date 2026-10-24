<?php

namespace App\Support;

use App\Models\Product;

class ProductSizes
{
    /**
     * @return list<string>
     */
    public static function optionsFor(Product $product): array
    {
        $fromVariants = [];
        foreach ($product->variants ?? [] as $variant) {
            if (! is_array($variant)) {
                continue;
            }
            $size = trim((string) ($variant['size'] ?? ''));
            if ($size !== '' && ! in_array($size, $fromVariants, true)) {
                $fromVariants[] = $size;
            }
        }
        if ($fromVariants !== []) {
            return $fromVariants;
        }

        return self::defaultsForCategory($product->category?->name ?? '');
    }

    public static function needsSize(Product $product): bool
    {
        return self::optionsFor($product) !== [];
    }

    /**
     * @return list<string>
     */
    public static function defaultsForCategory(string $category): array
    {
        $category = strtolower($category);
        if (str_contains($category, 'kid') || str_contains($category, 'child') || str_contains($category, 'baby') || str_contains($category, 'infant')) {
            return ['Age 1/2', 'Age 3/4', 'Age 5/6', 'Age 7/8', 'Age 9/10', 'Age 11/12', 'Adult'];
        }
        if (
            str_contains($category, 'men')
            || str_contains($category, 'woman')
            || str_contains($category, 'women')
            || str_contains($category, 'ladies')
            || str_contains($category, 'gents')
            || str_contains($category, 'fashion')
            || str_contains($category, 'apparel')
            || str_contains($category, 'clothing')
            || str_contains($category, 'wear')
        ) {
            return ['S', 'M', 'L', 'XL', 'XXL'];
        }

        return [];
    }

    /**
     * @return array{sku: ?string, price: int}
     */
    public static function matchVariant(Product $product, ?string $size, ?string $color = null): array
    {
        $size = trim((string) $size);
        $color = trim((string) $color);
        foreach ($product->variants ?? [] as $variant) {
            if (! is_array($variant)) {
                continue;
            }
            $variantSize = trim((string) ($variant['size'] ?? ''));
            $variantColor = trim((string) ($variant['color'] ?? ''));
            $sizeOk = $size === '' || $variantSize === '' || $variantSize === $size;
            $colorOk = $color === '' || $variantColor === '' || $variantColor === $color;
            if ($sizeOk && $colorOk && ($variantSize === $size || $size === '')) {
                if ($size !== '' && $variantSize !== $size) {
                    continue;
                }

                return [
                    'sku' => filled($variant['sku'] ?? null) ? (string) $variant['sku'] : null,
                    'price' => (int) ($variant['price'] ?? $product->price),
                ];
            }
        }

        if ($size !== '') {
            foreach ($product->variants ?? [] as $variant) {
                if (! is_array($variant)) {
                    continue;
                }
                if (trim((string) ($variant['size'] ?? '')) === $size) {
                    return [
                        'sku' => filled($variant['sku'] ?? null) ? (string) $variant['sku'] : null,
                        'price' => (int) ($variant['price'] ?? $product->price),
                    ];
                }
            }
        }

        return ['sku' => null, 'price' => (int) $product->price];
    }
}

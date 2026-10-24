<?php

namespace App\Support;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;

class Catalog
{
    public static function store(): array
    {
        $phone = Setting::get('phone', '+880 1777-012681');

        return [
            'name' => Setting::get('name', 'Buybari'),
            'tagline' => Setting::get('tagline', 'Everything your bari needs: home, kitchen, gadgets, fashion and food, delivered to your door anywhere in Bangladesh.'),
            'logo' => Setting::get('logo', '/images/logo.png'),
            'phone' => $phone,
            'phoneLink' => Setting::get('phone_link', '+8801777012681'),
            'whatsapp' => Setting::get('whatsapp', '8801777012681'),
            'email' => Setting::get('email', 'contactus@buybari.com'),
            'address' => Setting::get('address', 'Dhaka, Bangladesh'),
            'facebook' => Setting::get('facebook', 'https://www.facebook.com/share/1CRT4Dpc91/'),
            'hours' => Setting::get('hours', 'Saturday to Thursday, 10:00 AM to 8:00 PM'),
            'deliveryInsideDhaka' => (int) Setting::get('delivery_inside', '70'),
            'deliveryOutsideDhaka' => (int) Setting::get('delivery_outside', '130'),
        ];
    }

    public static function payload(): array
    {
        return [
            'store' => self::store(),
            'slides' => Banner::query()->where('is_active', true)->orderBy('sort')->orderBy('id')->get()->map(fn (Banner $banner) => [
                'image' => $banner->imageUrl(),
                'alt' => $banner->alt,
                'plain' => $banner->plain,
                'href' => $banner->link ?: '/#products',
                'eyebrow' => $banner->eyebrow,
                'title' => $banner->title,
                'text' => $banner->text,
                'cta' => $banner->cta,
                'category' => $banner->category,
            ])->values(),
            'categories' => Category::query()->orderBy('sort')->orderBy('name')->get()->map(fn (Category $category) => [
                'name' => $category->name,
                'icon' => $category->icon,
            ])->values(),
            'sections' => [
                ['id' => 'hot', 'title' => 'Hot Products', 'badge' => 'hot'],
                ['id' => 'discount', 'title' => 'Discount Products', 'badge' => 'discount'],
                ['id' => 'new', 'title' => 'New Arrival Products', 'badge' => 'new'],
                ['id' => 'regular', 'title' => 'Regular Products', 'badge' => 'feature'],
            ],
            'products' => Product::query()->with('category')->where('is_active', true)->orderBy('id')->get()->map(function (Product $product) {
                $sizeOptions = ProductSizes::optionsFor($product);

                return [
                    'id' => $product->slug,
                    'name' => $product->name,
                    'image' => $product->imageUrl(),
                    'price' => (int) $product->price,
                    'oldPrice' => (int) $product->old_price > (int) $product->price ? (int) $product->old_price : 0,
                    'category' => $product->category?->name ?? 'Shop',
                    'section' => $product->section,
                    'badge' => $product->badge,
                    'rating' => (int) $product->rating,
                    'reviews' => (int) $product->reviews,
                    'description' => $product->description,
                    'variants' => $product->variants ?? [],
                    'sizeOptions' => $sizeOptions,
                    'needsSize' => $sizeOptions !== [],
                    'bProductId' => $product->b_product_id,
                ];
            })->values(),
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@gmail.com')],
            ['name' => 'Buybari Admin', 'password' => env('ADMIN_PASSWORD', 'admin000')]
        );

        Setting::putMany([
            'name' => 'Buybari',
            'tagline' => 'Everything your bari needs: home, kitchen, gadgets, fashion and food, delivered to your door anywhere in Bangladesh.',
            'logo' => '/images/logo.png',
            'phone' => '+880 1777-012681',
            'phone_link' => '+8801777012681',
            'whatsapp' => '8801777012681',
            'email' => 'contactus@buybari.com',
            'address' => 'Dhaka, Bangladesh',
            'facebook' => 'https://www.facebook.com/share/1CRT4Dpc91/',
            'hours' => 'Saturday to Thursday, 10:00 AM to 8:00 PM',
            'delivery_inside' => '70',
            'delivery_outside' => '130',
        ]);

        $icons = [
            'Home Decor' => 'sofa',
            'Home & Kitchen' => 'kitchen',
            'Electronics' => 'plug',
            'Smart Gadgets' => 'watch',
            "Men's Fashion" => 'shirt',
            "Women's Fashion" => 'dress',
            "Kids' Fashion" => 'kid',
            'Life Style' => 'sparkle',
            'Groceries & Food' => 'food',
            'Bath & Hardware' => 'wrench',
        ];
        $categories = [];
        $sort = 1;
        foreach ($icons as $name => $icon) {
            $categories[$name] = Category::query()->updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'icon' => $icon, 'sort' => $sort++]
            );
        }

        $badges = ['hot' => 'hot', 'discount' => 'discount', 'new' => 'new', 'regular' => 'feature'];
        $js = file_get_contents(base_path('js/data.js'));
        preg_match('/const RAW = \{([\s\S]*?)\n\};/', $js, $rawMatch);
        preg_match_all('/(hot|discount|new|regular):\s*\[([\s\S]*?)\n\s*\],/', $rawMatch[1] ?? '', $sections, PREG_SET_ORDER);
        foreach ($sections as $section) {
            $rows = [];
            foreach (preg_split('/\r?\n/', $section[2]) as $line) {
                $line = trim(rtrim(trim($line), ','));
                if (! str_starts_with($line, '[')) {
                    continue;
                }
                $row = json_decode($line, true);
                if (is_array($row) && count($row) >= 8) {
                    $rows[] = $row;
                }
            }
            foreach ($rows as $row) {
                [$slug, $name, $price, $old, $category, $rating, $reviews, $description] = $row;
                $categoryModel = $categories[$category] ?? Category::query()->firstOrCreate(
                    ['slug' => Str::slug($category)],
                    ['name' => $category, 'icon' => 'grid', 'sort' => 50]
                );
                Product::query()->updateOrCreate(
                    ['slug' => $slug],
                    [
                        'category_id' => $categoryModel->id,
                        'name' => $name,
                        'image' => '/images/products/'.$slug.'.jpg',
                        'price' => (int) $price,
                        'old_price' => (int) $old,
                        'description' => $description,
                        'section' => $section[1],
                        'badge' => $badges[$section[1]],
                        'rating' => (int) $rating,
                        'reviews' => (int) $reviews,
                        'is_active' => true,
                    ]
                );
            }
        }

        if (Product::query()->count() < 20) {
            throw new RuntimeException('The product list in js/data.js was not imported. Check the RAW catalog.');
        }

        $banners = [
            ['/images/banners/client-1.jpeg', 'Buybari: everything you need, one place', 1],
            ['/images/banners/client-2.jpeg', 'Welcome to Buybari', 2],
        ];
        foreach ($banners as [$image, $alt, $sort]) {
            Banner::query()->updateOrCreate(
                ['image' => $image],
                ['alt' => $alt, 'link' => '/#products', 'plain' => true, 'sort' => $sort, 'is_active' => true]
            );
        }
    }
}

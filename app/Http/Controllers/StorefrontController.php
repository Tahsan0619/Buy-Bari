<?php

namespace App\Http\Controllers;

use App\Support\Catalog;

class StorefrontController extends Controller
{
    public function home()
    {
        return view('store.home', $this->shared('home', 'Buybari | Online Shopping in Bangladesh'));
    }

    public function product(string $slug)
    {
        return view('store.product', $this->shared('product', 'Product | Buybari', $slug));
    }

    public function page(string $page)
    {
        abort_unless(view()->exists('store.'.$page), 404);
        $titles = [
            'about' => 'About Us | Buybari',
            'contact' => 'Contact Us | Buybari',
            'terms' => 'Terms & Conditions | Buybari',
            'privacy' => 'Privacy Policy | Buybari',
            'refund' => 'Refund & Return Policy | Buybari',
            'payment' => 'Payment Policy | Buybari',
        ];

        return view('store.'.$page, $this->shared($page, $titles[$page] ?? 'Buybari'));
    }

    private function shared(string $page, string $title, ?string $productId = null): array
    {
        return [
            'page' => $page,
            'title' => $title,
            'catalog' => Catalog::payload(),
            'productId' => $productId,
            'pages' => [
                'home' => '/',
                'campaign' => '/#discount',
                'shop' => '/#products',
                'about' => '/about',
                'contact' => '/contact',
                'refund' => '/refund',
                'privacy' => '/privacy',
                'terms' => '/terms',
                'payment' => '/payment',
            ],
        ];
    }
}

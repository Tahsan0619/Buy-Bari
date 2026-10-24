<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Services\NittozClient;

class DashboardController extends Controller
{
    public function index(NittozClient $nittoz)
    {
        return view('admin.dashboard', [
            'products' => Product::query()->count(),
            'orders' => Order::query()->count(),
            'pending' => Order::query()->where('status', 'pending')->count(),
            'messages' => Message::query()->where('is_read', false)->count(),
            'sales' => (int) Order::query()->where('status', '!=', 'cancelled')->sum('total'),
            'recent' => Order::query()->latest()->limit(6)->get(),
            'nittozReady' => $nittoz->configured(),
        ]);
    }
}

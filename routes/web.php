<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\NittozController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StorefrontController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [StorefrontController::class, 'home'])->name('home');
Route::get('/product/{slug}', [StorefrontController::class, 'product'])->name('product');
Route::get('/about', [StorefrontController::class, 'page'])->defaults('page', 'about')->name('about');
Route::get('/contact', [StorefrontController::class, 'page'])->defaults('page', 'contact')->name('contact');
Route::get('/terms', [StorefrontController::class, 'page'])->defaults('page', 'terms')->name('terms');
Route::get('/privacy', [StorefrontController::class, 'page'])->defaults('page', 'privacy')->name('privacy');
Route::get('/refund', [StorefrontController::class, 'page'])->defaults('page', 'refund')->name('refund');
Route::get('/payment', [StorefrontController::class, 'page'])->defaults('page', 'payment')->name('payment');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'show'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        Route::get('/nittoz', [NittozController::class, 'index'])->name('nittoz');
        Route::post('/nittoz/sync', [NittozController::class, 'sync'])->name('nittoz.sync');
        Route::post('/nittoz/lookup', [NittozController::class, 'lookup'])->name('nittoz.lookup');
        Route::get('/nittoz/simple', [NittozController::class, 'simple'])->name('nittoz.simple');
        Route::get('/nittoz/variable', [NittozController::class, 'variable'])->name('nittoz.variable');
        Route::post('/nittoz/import', [NittozController::class, 'import'])->name('nittoz.import');

        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
        Route::post('/banners', [BannerController::class, 'store'])->name('banners.store');
        Route::put('/banners/{banner}', [BannerController::class, 'update'])->name('banners.update');
        Route::delete('/banners/{banner}', [BannerController::class, 'destroy'])->name('banners.destroy');

        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
        Route::post('/orders/{order}/transfer', [OrderController::class, 'transfer'])->name('orders.transfer');

        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::post('/messages/{message}/read', [MessageController::class, 'read'])->name('messages.read');

        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
});

Route::fallback(function (Request $request) {
    if ($request->isMethod('GET') && preg_match('#^admin(/|$)#i', $request->path())) {
        return redirect('/admin');
    }

    abort(404);
});

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->default('grid');
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('b_product_id')->nullable()->unique();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->unsignedInteger('price')->default(0);
            $table->unsignedInteger('old_price')->default(0);
            $table->text('description')->nullable();
            $table->string('section')->default('regular');
            $table->string('badge')->default('feature');
            $table->unsignedTinyInteger('rating')->default(5);
            $table->unsignedInteger('reviews')->default(0);
            $table->boolean('is_variable')->default(false);
            $table->json('variants')->nullable();
            $table->json('raw')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('synced_at')->nullable();
            $table->timestamps();
        });

        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('alt')->nullable();
            $table->string('link')->nullable();
            $table->boolean('plain')->default(true);
            $table->string('eyebrow')->nullable();
            $table->string('title')->nullable();
            $table->text('text')->nullable();
            $table->string('cta')->nullable();
            $table->string('category')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->unique();
            $table->string('invoice_number')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('zone')->default('inside');
            $table->text('address');
            $table->string('area')->nullable();
            $table->unsignedInteger('subtotal')->default(0);
            $table->unsignedInteger('delivery_cost')->default(0);
            $table->unsignedInteger('discount')->default(0);
            $table->unsignedInteger('advance')->default(0);
            $table->unsignedInteger('total')->default(0);
            $table->string('payment_type')->default('cod');
            $table->string('payment_gateway')->nullable();
            $table->string('transaction_id')->nullable();
            $table->text('special_notes')->nullable();
            $table->string('status')->default('pending');
            $table->json('nittoz_response')->nullable();
            $table->timestamp('transferred_at')->nullable();
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('b_product_id')->nullable();
            $table->string('name');
            $table->unsignedInteger('price')->default(0);
            $table->unsignedInteger('qty')->default(1);
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('variant_sku')->nullable();
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('subject')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('settings');
    }
};

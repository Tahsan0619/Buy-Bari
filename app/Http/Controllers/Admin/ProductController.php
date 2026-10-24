<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::query()->with('category')->latest()->paginate(20),
        ]);
    }

    public function create()
    {
        return view('admin.products.form', ['product' => new Product(['section' => 'regular', 'badge' => 'feature', 'rating' => 5, 'is_active' => true]), 'categories' => Category::query()->orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $product = new Product;
        $this->save($request, $product);

        return redirect()->route('admin.products.index')->with('status', 'Product added.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', ['product' => $product, 'categories' => Category::query()->orderBy('name')->get()]);
    }

    public function update(Request $request, Product $product)
    {
        $this->save($request, $product);

        return redirect()->route('admin.products.index')->with('status', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('status', 'Product deleted.');
    }

    private function save(Request $request, Product $product): void
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:180', Rule::unique('products', 'slug')->ignore($product->id)],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'integer', 'min:0'],
            'old_price' => ['nullable', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'section' => ['required', 'in:hot,discount,new,regular'],
            'badge' => ['required', 'in:hot,discount,new,feature'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'reviews' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'string', 'max:500'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $image = $data['image'] ?? $product->image;
        if ($request->hasFile('image_file')) {
            $image = '/storage/'.$request->file('image_file')->store('products', 'public');
        }

        $product->fill([
            'name' => $data['name'],
            'slug' => $data['slug'] ?: Str::slug($data['name']),
            'category_id' => $data['category_id'],
            'price' => $data['price'],
            'old_price' => $data['old_price'] ?? 0,
            'description' => $data['description'] ?? '',
            'section' => $data['section'],
            'badge' => $data['badge'],
            'rating' => $data['rating'],
            'reviews' => $data['reviews'] ?? 0,
            'image' => $image,
            'is_active' => $request->boolean('is_active'),
        ]);
        if (! $product->slug) {
            $product->slug = 'product-'.Str::lower(Str::random(5));
        }
        $product->save();
    }
}

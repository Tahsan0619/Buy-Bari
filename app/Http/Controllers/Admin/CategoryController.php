<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::query()->withCount('products')->orderBy('sort')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'icon' => ['required', 'string', 'max:40'],
            'sort' => ['nullable', 'integer', 'min:0'],
        ]);
        Category::query()->create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'icon' => $data['icon'],
            'sort' => $data['sort'] ?? 0,
        ]);

        return back()->with('status', 'Category added.');
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'icon' => ['required', 'string', 'max:40'],
            'sort' => ['nullable', 'integer', 'min:0'],
            'slug' => ['nullable', 'string', 'max:80', Rule::unique('categories', 'slug')->ignore($category->id)],
        ]);
        $category->update([
            'name' => $data['name'],
            'slug' => $data['slug'] ?: Str::slug($data['name']),
            'icon' => $data['icon'],
            'sort' => $data['sort'] ?? 0,
        ]);

        return back()->with('status', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return back()->withErrors(['name' => 'Move or delete the products in this category first.']);
        }
        $category->delete();

        return back()->with('status', 'Category deleted.');
    }
}

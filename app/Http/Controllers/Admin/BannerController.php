<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        return view('admin.banners.index', [
            'banners' => Banner::query()->orderBy('sort')->orderBy('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if (empty($data['image']) && ! $request->hasFile('image_file')) {
            return back()->withErrors(['image' => 'Add an image path or upload a file.'])->withInput();
        }
        $data['image'] = $this->image($request, $data['image'] ?? '');
        $data['plain'] = $request->boolean('plain');
        $data['is_active'] = $request->boolean('is_active');
        Banner::query()->create($data);

        return back()->with('status', 'Banner added.');
    }

    public function update(Request $request, Banner $banner)
    {
        $data = $this->validated($request);
        $data['image'] = $this->image($request, $data['image'] ?? $banner->image);
        $data['plain'] = $request->boolean('plain');
        $data['is_active'] = $request->boolean('is_active');
        $banner->update($data);

        return back()->with('status', 'Banner updated.');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();

        return back()->with('status', 'Banner deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'image' => ['nullable', 'string', 'max:500'],
            'image_file' => ['nullable', 'image', 'max:5120'],
            'alt' => ['nullable', 'string', 'max:180'],
            'link' => ['nullable', 'string', 'max:180'],
            'sort' => ['nullable', 'integer', 'min:0'],
            'eyebrow' => ['nullable', 'string', 'max:80'],
            'title' => ['nullable', 'string', 'max:180'],
            'text' => ['nullable', 'string', 'max:300'],
            'cta' => ['nullable', 'string', 'max:80'],
            'category' => ['nullable', 'string', 'max:80'],
        ]);
    }

    private function image(Request $request, string $current): string
    {
        if ($request->hasFile('image_file')) {
            return '/storage/'.$request->file('image_file')->store('banners', 'public');
        }

        return $current;
    }
}

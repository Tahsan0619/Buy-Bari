<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\NittozClient;
use App\Services\NittozImporter;
use App\Services\NittozMapper;
use Illuminate\Http\Request;
use RuntimeException;

class NittozController extends Controller
{
    public function index(NittozClient $client)
    {
        return view('admin.products.nittoz', [
            'orderReady' => $client->configured(),
            'baseUrl' => rtrim((string) config('nittoz.base_url'), '/'),
            'orderUrl' => (string) config('nittoz.order_url'),
        ]);
    }

    public function sync(NittozImporter $importer)
    {
        try {
            $result = $importer->syncAll();
        } catch (RuntimeException $e) {
            return back()->withErrors(['sync' => $e->getMessage()]);
        }

        $note = "Nittoz catalog reports {$result['api_total']} products. Synced {$result['pages']} page(s) and {$result['categories']} categories. Added {$result['added']}, updated {$result['updated']}. Shop now has {$result['shop_total']} Nittoz-linked products.";
        if ($result['failed']) {
            $note .= ' Some items failed: '.implode(' ', array_slice($result['failed'], 0, 5));
        }

        return back()->with('status', $note);
    }

    public function lookup(Request $request, NittozClient $client, NittozMapper $mapper)
    {
        $data = $request->validate([
            'b_product_id' => ['required', 'string', 'max:180'],
        ]);
        $identifier = trim($data['b_product_id']);

        try {
            $detail = $client->product($identifier);
        } catch (RuntimeException $e) {
            return back()->withErrors(['b_product_id' => $e->getMessage()])->withInput();
        }

        $payload = is_array($detail['data'] ?? null) ? $detail['data'] : $detail;
        $product = is_array($payload['product'] ?? null) ? $payload['product'] : $payload;
        $mapped = $mapper->map($product);
        session(['nittoz_preview' => $mapped]);

        return redirect()->route($mapped['is_variable'] ? 'admin.nittoz.variable' : 'admin.nittoz.simple');
    }

    public function simple()
    {
        return $this->preview('admin.products.nittoz-product-add');
    }

    public function variable()
    {
        return $this->preview('admin.products.nittoz-variable-product');
    }

    public function import(Request $request, NittozImporter $importer)
    {
        $preview = session('nittoz_preview');
        if (! is_array($preview)) {
            return redirect()->route('admin.nittoz')->withErrors(['sync' => 'Look up a Nittoz product before saving it.']);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:180'],
            'price' => ['required', 'integer', 'min:0'],
            'old_price' => ['nullable', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:500'],
            'category_id' => ['required', 'exists:categories,id'],
            'variants' => ['nullable', 'array'],
            'variants.*.sku' => ['nullable', 'string', 'max:120'],
            'variants.*.color' => ['nullable', 'string', 'max:80'],
            'variants.*.size' => ['nullable', 'string', 'max:80'],
            'variants.*.price' => ['nullable', 'integer', 'min:0'],
            'variants.*.image' => ['nullable', 'string', 'max:500'],
        ]);

        $preview['name'] = $data['name'];
        $preview['price'] = $data['price'];
        $preview['old_price'] = $data['old_price'] ?? 0;
        $preview['description'] = $data['description'] ?? '';
        $preview['image'] = $data['image'] ?? '';
        $preview['variants'] = array_values($data['variants'] ?? $preview['variants'] ?? []);
        $preview['is_variable'] = count($preview['variants']) > 0 && ($preview['is_variable'] || count($preview['variants']) > 1);

        try {
            $product = $importer->importMapped($preview, (int) $data['category_id']);
        } catch (RuntimeException $e) {
            return back()->withErrors(['name' => $e->getMessage()])->withInput();
        }

        session()->forget('nittoz_preview');

        return redirect()->route('admin.products.edit', $product)->with('status', 'Nittoz product added to the shop.');
    }

    private function preview(string $view)
    {
        $preview = session('nittoz_preview');
        if (! is_array($preview)) {
            return redirect()->route('admin.nittoz');
        }

        return view($view, [
            'preview' => $preview,
            'categories' => Category::query()->orderBy('name')->get(),
        ]);
    }
}

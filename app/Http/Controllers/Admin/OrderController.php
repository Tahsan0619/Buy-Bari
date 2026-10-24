<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\NittozClient;
use App\Support\ProductSizes;
use Illuminate\Http\Request;
use RuntimeException;

class OrderController extends Controller
{
    public function index()
    {
        $status = request('status');

        return view('admin.orders.index', [
            'orders' => Order::query()
                ->when($status, fn ($q) => $q->where('status', $status))
                ->latest()
                ->paginate(20)
                ->withQueryString(),
            'status' => $status,
        ]);
    }

    public function show(Order $order)
    {
        $order->load('items.product');

        $products = Product::query()->with('category')->orderBy('name')->get();

        return view('admin.orders.show', [
            'order' => $order,
            'products' => $products->map(fn (Product $product) => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => (int) $product->price,
                'b_product_id' => $product->b_product_id,
                'sizes' => ProductSizes::optionsFor($product),
                'variants' => $product->variants ?? [],
            ]),
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'action' => ['required', 'in:update,status'],
            'name' => ['required_if:action,update', 'string', 'max:120'],
            'phone' => ['required_if:action,update', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:160'],
            'area' => ['nullable', 'string', 'max:120'],
            'address' => ['required_if:action,update', 'string', 'max:500'],
            'discount' => ['nullable', 'integer', 'min:0'],
            'advance' => ['nullable', 'integer', 'min:0'],
            'special_notes' => ['nullable', 'string', 'max:500'],
            'status' => ['required_if:action,status', 'in:pending,confirmed,transferred,failed,cancelled'],
            'related_product_id' => ['nullable', 'integer', 'exists:products,id'],
            'size' => ['nullable', 'string', 'max:80'],
            'color' => ['nullable', 'string', 'max:80'],
            'qty' => ['nullable', 'integer', 'min:1', 'max:20'],
        ]);

        if ($data['action'] === 'status') {
            $order->update(['status' => $data['status']]);

            return back()->with('status', 'Order status updated.');
        }

        $order->fill([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
            'area' => $data['area'] ?? null,
            'address' => $data['address'],
            'discount' => $data['discount'] ?? 0,
            'advance' => $data['advance'] ?? 0,
            'special_notes' => $data['special_notes'] ?? null,
        ]);

        if (! empty($data['related_product_id'])) {
            $product = Product::query()->with('category')->find($data['related_product_id']);
            if ($product) {
                $qty = (int) ($data['qty'] ?? 1);
                $size = trim((string) ($data['size'] ?? ''));
                $color = trim((string) ($data['color'] ?? ''));
                if (ProductSizes::needsSize($product) && $size === '') {
                    return back()->withErrors(['size' => 'Choose a size for '.$product->name.'.'])->withInput();
                }
                $match = ProductSizes::matchVariant($product, $size !== '' ? $size : null, $color !== '' ? $color : null);
                $variantSku = $match['sku'] ?? null;
                $price = $variantSku ? $product->unitPrice($variantSku) : (int) ($match['price'] ?: $product->price);
                $existing = $order->items()
                    ->where('product_id', $product->id)
                    ->where('size', $size !== '' ? $size : null)
                    ->where('color', $color !== '' ? $color : null)
                    ->where('variant_sku', $variantSku)
                    ->first();
                if ($existing) {
                    $existing->update(['qty' => $existing->qty + $qty, 'price' => $price, 'variant_sku' => $variantSku]);
                } else {
                    OrderItem::query()->create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'b_product_id' => $product->b_product_id,
                        'name' => $product->name,
                        'price' => $price,
                        'qty' => $qty,
                        'size' => $size !== '' ? $size : null,
                        'color' => $color !== '' ? $color : null,
                        'variant_sku' => $variantSku,
                    ]);
                }
            }
        }

        $order->load('items');
        $subtotal = $order->items->sum(fn (OrderItem $item) => $item->price * $item->qty);
        $order->subtotal = $subtotal;
        $order->total = max(0, $subtotal + $order->delivery_cost - $order->discount);
        $order->save();

        return back()->with('status', 'Order updated.');
    }

    public function transfer(Order $order, NittozClient $client)
    {
        $order->load('items.product.category');
        $missing = $order->items->filter(fn (OrderItem $item) => ! $item->b_product_id);
        if ($missing->isNotEmpty()) {
            return back()->withErrors(['transfer' => 'These items are not linked to a Nittoz product id, so the order cannot be transferred yet: '.$missing->pluck('name')->implode(', ').'.']);
        }
        if ($order->items->isEmpty()) {
            return back()->withErrors(['transfer' => 'Add at least one product before transferring this order.']);
        }

        $missingSizes = $order->items->filter(function (OrderItem $item) {
            $product = $item->product;
            if (! $product) {
                return false;
            }
            $product->loadMissing('category');

            return ProductSizes::needsSize($product) && blank($item->size) && blank($item->variant_sku);
        });
        if ($missingSizes->isNotEmpty()) {
            return back()->withErrors(['transfer' => 'Set a size on these items before transferring: '.$missingSizes->pluck('name')->implode(', ').'.']);
        }

        $sizeNotes = $order->items
            ->filter(fn (OrderItem $item) => filled($item->size))
            ->map(fn (OrderItem $item) => $item->name.': '.$item->size.($item->color ? ' / '.$item->color : ''))
            ->implode('; ');
        $notes = trim((string) $order->special_notes);
        if ($sizeNotes !== '') {
            $notes = trim($notes.($notes !== '' ? "\n" : '').'Sizes: '.$sizeNotes);
        }

        $deliveryCost = max(60, (int) $order->delivery_cost);
        $payload = [
            'invoice_number' => $order->invoice_number ?: $order->order_no,
            'customer_name' => $order->name,
            'customer_phone' => $order->phone,
            'delivery_cost' => $deliveryCost,
            'customer_address' => trim(($order->area ? $order->area.', ' : '').$order->address),
            'price' => (int) $order->subtotal,
            'discount' => (int) $order->discount,
            'advance' => (int) $order->advance,
            'product_quantity' => (int) $order->items->sum('qty'),
            'delivery_charge_type' => $order->zone === 'outside' ? 'outside' : 'inside',
            'payment_type' => $order->payment_type ?: 'cod',
            'special_notes' => $notes !== '' ? $notes : null,
            'payment_gateway' => $order->payment_gateway,
            'transaction_id' => $order->transaction_id,
            'products' => $order->items->map(function (OrderItem $item) {
                $line = [
                    'id' => (int) $item->b_product_id,
                    'price' => (int) $item->price,
                    'qty' => (int) $item->qty,
                ];
                if (filled($item->variant_sku)) {
                    $line['variant_sku'] = (string) $item->variant_sku;
                }

                return $line;
            })->values()->all(),
        ];

        try {
            $response = $client->createOrder($payload);
        } catch (RuntimeException $e) {
            $order->update(['status' => 'failed', 'nittoz_response' => ['message' => $e->getMessage()]]);

            return back()->withErrors(['transfer' => $e->getMessage()]);
        }

        $order->update([
            'status' => 'transferred',
            'transferred_at' => now(),
            'nittoz_response' => $response,
            'invoice_number' => $response['invoice'] ?? $order->invoice_number,
        ]);

        return back()->with('status', $response['message'] ?? 'Order transferred to Nittoz.');
    }
}

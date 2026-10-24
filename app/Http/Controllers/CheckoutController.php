<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Support\Catalog;
use App\Support\ProductSizes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:120'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'min:8', 'max:500'],
            'zone' => ['required', 'in:inside,outside'],
            'lines' => ['required', 'array', 'min:1'],
            'lines.*.id' => ['required', 'string'],
            'lines.*.qty' => ['required', 'integer', 'min:1', 'max:20'],
            'lines.*.color' => ['nullable', 'string', 'max:80'],
            'lines.*.size' => ['nullable', 'string', 'max:80'],
            'lines.*.variant_sku' => ['nullable', 'string', 'max:120'],
        ]);

        $phone = preg_replace('/[\s-]/', '', $data['phone']) ?? '';
        if (! preg_match('/^(?:\+?88)?01[3-9]\d{8}$/', $phone)) {
            return response()->json(['message' => 'Enter a valid Bangladeshi mobile number.', 'errors' => ['phone' => ['Enter a valid Bangladeshi mobile number.']]], 422);
        }

        $store = Catalog::store();
        $delivery = $data['zone'] === 'outside' ? $store['deliveryOutsideDhaka'] : $store['deliveryInsideDhaka'];

        $order = DB::transaction(function () use ($data, $phone, $delivery) {
            $order = Order::query()->create([
                'order_no' => 'TMP'.uniqid(),
                'name' => $data['name'],
                'phone' => $phone,
                'zone' => $data['zone'],
                'address' => $data['address'],
                'area' => $data['zone'] === 'outside' ? 'Outside Dhaka' : 'Inside Dhaka',
                'delivery_cost' => $delivery,
                'payment_type' => 'cod',
                'status' => 'pending',
            ]);
            $orderNo = 'BB'.str_pad((string) $order->id, 6, '0', STR_PAD_LEFT);
            $subtotal = 0;

            foreach ($data['lines'] as $line) {
                $product = Product::query()->with('category')->where('slug', $line['id'])->where('is_active', true)->first();
                if (! $product) {
                    abort(response()->json(['message' => 'A product in this order is no longer available.', 'errors' => ['address' => ['A product in this order is no longer available.']]], 422));
                }

                $size = trim((string) ($line['size'] ?? ''));
                $color = trim((string) ($line['color'] ?? ''));
                if (ProductSizes::needsSize($product) && $size === '') {
                    abort(response()->json([
                        'message' => 'Please choose a size for '.$product->name.'.',
                        'errors' => ['address' => ['Please choose a size for '.$product->name.'.']],
                    ], 422));
                }

                $match = ProductSizes::matchVariant($product, $size !== '' ? $size : null, $color !== '' ? $color : null);
                $variantSku = trim((string) ($line['variant_sku'] ?? '')) ?: ($match['sku'] ?? null);
                $price = $variantSku ? $product->unitPrice($variantSku) : (int) ($match['price'] ?: $product->price);
                $qty = (int) $line['qty'];
                $subtotal += $price * $qty;
                OrderItem::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'b_product_id' => $product->b_product_id,
                    'name' => $product->name,
                    'price' => $price,
                    'qty' => $qty,
                    'color' => $color !== '' ? $color : null,
                    'size' => $size !== '' ? $size : null,
                    'variant_sku' => $variantSku ?: null,
                ]);
            }

            $order->update([
                'order_no' => $orderNo,
                'invoice_number' => $orderNo,
                'subtotal' => $subtotal,
                'total' => $subtotal + $delivery,
            ]);

            return $order->fresh();
        });

        return response()->json(['order_no' => $order->order_no]);
    }
}

@extends('admin.layout')
@section('title', 'Order '.$order->order_no)
@section('content')
  @if ($errors->any())
    <div class="panel" style="border-color:#c44;margin-bottom:14px">
      @foreach ($errors->all() as $error)
        <p style="color:#c44;margin:0">{{ $error }}</p>
      @endforeach
    </div>
  @endif
  @if (session('status'))
    <p class="muted" style="margin-bottom:14px">{{ session('status') }}</p>
  @endif

  <div class="row">
    <p class="muted">Status: {{ ucfirst($order->status) }} @if ($order->transferred_at) · transferred {{ $order->transferred_at->format('d M Y, h:i A') }} @endif</p>
    <form method="POST" action="{{ route('admin.orders.transfer', $order) }}">
      @csrf
      <button class="btn" type="submit">Transfer to Nittoz</button>
    </form>
  </div>

  <table>
    <tr><th>Product</th><th>Nittoz id</th><th>Options</th><th>Qty</th><th>Price</th></tr>
    @foreach ($order->items as $item)
      <tr>
        <td>{{ $item->name }}</td>
        <td>{{ $item->b_product_id ?: 'Not linked' }}</td>
        <td>{{ trim(($item->color ? $item->color.' / ' : '').($item->size ?: '')) ?: '-' }} @if ($item->variant_sku)<br><span class="muted">SKU {{ $item->variant_sku }}</span>@endif</td>
        <td>{{ $item->qty }}</td>
        <td>৳{{ number_format($item->price) }}</td>
      </tr>
    @endforeach
  </table>
  <p>Subtotal ৳{{ number_format($order->subtotal) }} · Delivery ৳{{ number_format($order->delivery_cost) }} · Discount ৳{{ number_format($order->discount) }} · Advance ৳{{ number_format($order->advance) }} · <strong>Total ৳{{ number_format($order->total) }}</strong></p>

  <form class="panel" method="POST" action="{{ route('admin.orders.update', $order) }}" id="order-update-form">
    @csrf @method('PUT')
    <input type="hidden" name="action" value="update" />
    <h2>Update customer and add a product</h2>
    <div class="grid-2">
      <label>Name<input name="name" value="{{ old('name', $order->name) }}" required /></label>
      <label>Phone<input name="phone" value="{{ old('phone', $order->phone) }}" required /></label>
      <label>Email<input name="email" value="{{ old('email', $order->email) }}" /></label>
      <label>Area<input name="area" value="{{ old('area', $order->area) }}" /></label>
      <label>Discount<input type="number" name="discount" min="0" value="{{ old('discount', $order->discount) }}" /></label>
      <label>Advance<input type="number" name="advance" min="0" value="{{ old('advance', $order->advance) }}" /></label>
    </div>
    <label>Address<textarea name="address" rows="2" required>{{ old('address', $order->address) }}</textarea></label>
    <label>Special notes<textarea name="special_notes" rows="2">{{ old('special_notes', $order->special_notes) }}</textarea></label>
    <div class="grid-2">
      <label>Add a product
        <select name="related_product_id" id="related-product">
          <option value="">Do not add a product</option>
          @foreach ($products as $product)
            <option value="{{ $product['id'] }}">{{ $product['name'] }}{{ $product['b_product_id'] ? ' (#'.$product['b_product_id'].')' : '' }}{{ !empty($product['sizes']) ? ' · sizes' : '' }}</option>
          @endforeach
        </select>
      </label>
      <label>Qty<input type="number" name="qty" min="1" value="1" /></label>
      <label>Color<input name="color" id="related-color" value="{{ old('color') }}" /></label>
      <label>Size
        <select name="size" id="related-size">
          <option value="">No size</option>
        </select>
      </label>
    </div>
    <p class="muted" id="size-hint">Pick a product to see size options (API sizes when available, otherwise Men/Women S–XXL or Kids age bands).</p>
    <button class="btn" type="submit">Save order</button>
  </form>

  <form class="panel" method="POST" action="{{ route('admin.orders.update', $order) }}" style="margin-top:14px">
    @csrf @method('PUT')
    <input type="hidden" name="action" value="status" />
    <label>Status only
      <select name="status">
        @foreach (['pending', 'confirmed', 'transferred', 'failed', 'cancelled'] as $value)
          <option value="{{ $value }}" @selected($order->status === $value)>{{ ucfirst($value) }}</option>
        @endforeach
      </select>
    </label>
    <button class="btn btn--ghost" type="submit">Update status</button>
  </form>

  @if ($order->nittoz_response)
    <h2>Last Nittoz response</h2>
    <pre>{{ json_encode($order->nittoz_response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
  @endif

  <script>
    (function () {
      const products = @json($products);
      const byId = Object.fromEntries(products.map((p) => [String(p.id), p]));
      const select = document.getElementById('related-product');
      const size = document.getElementById('related-size');
      const hint = document.getElementById('size-hint');
      const oldSize = @json(old('size', ''));
      const fill = () => {
        const product = byId[select.value];
        const sizes = product?.sizes || [];
        size.innerHTML = '<option value="">' + (sizes.length ? 'Choose size' : 'No size') + '</option>' +
          sizes.map((s) => '<option value="' + s.replace(/"/g, '&quot;') + '"' + (s === oldSize ? ' selected' : '') + '>' + s + '</option>').join('');
        hint.textContent = sizes.length
          ? 'This product needs a size before transfer. Options: ' + sizes.join(', ') + '.'
          : 'No size required for this product.';
      };
      select.addEventListener('change', fill);
      fill();
    })();
  </script>
@endsection

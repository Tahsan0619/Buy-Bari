@extends('admin.layout')
@section('title', 'Nittoz import')
@section('content')
  <section class="panel">
    <h2>Product sync</h2>
    <p>Products and categories can be downloaded without API keys. Sync walks every page of the Nittoz dropshipper catalog (the API currently exposes a fixed total, not a partial sample).</p>
    <pre>NITTOZ_BASE_URL={{ $baseUrl }}
NITTOZ_ORDER_URL={{ $orderUrl }}</pre>
    <form method="POST" action="{{ route('admin.nittoz.sync') }}" style="margin-top:12px">
      @csrf
      <button class="btn" type="submit">Sync products now</button>
    </form>
  </section>

  <section class="panel" style="margin-top:16px">
    <h2>Add one product by id or slug</h2>
    <p>Simple products open the simple form. Variable products open the variant form so color, size and SKU can be checked before saving.</p>
    <form method="POST" action="{{ route('admin.nittoz.lookup') }}">
      @csrf
      <label>Nittoz product id or slug<input type="text" name="b_product_id" value="{{ old('b_product_id') }}" required /></label>
      <button class="btn" type="submit">Load product</button>
    </form>
  </section>

  <section class="panel" style="margin-top:16px">
    <h2>Order transfer credentials</h2>
    @if ($orderReady)
      <p>Order credentials in <code>.env</code> are set. Transfer to Nittoz will send App-Key, App-Secret and Username.</p>
    @else
      <p>Keys are only needed when transferring an order. Product sync works without them. When the client sends the real values, replace these three lines in <code>.env</code> and reload this page.</p>
    @endif
    <pre>NITTOZ_APP_KEY=paste-your-app-key-here
NITTOZ_APP_SECRET=paste-your-app-secret-here
NITTOZ_USERNAME=paste-your-username-here</pre>
    <p class="muted">Docs: https://package.nittoz.com/api.html. Catalog GETs need no headers. POST place-order needs the three headers above.</p>
  </section>
@endsection

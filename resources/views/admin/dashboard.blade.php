@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
  <section class="cards">
    <article class="card"><strong>{{ $products }}</strong><span>Products</span></article>
    <article class="card"><strong>{{ $orders }}</strong><span>Orders</span></article>
    <article class="card"><strong>{{ $pending }}</strong><span>Pending orders</span></article>
    <article class="card"><strong>{{ number_format($sales) }}</strong><span>Sales (BDT)</span></article>
  </section>
  <section class="panel" style="margin-top:16px">
    <h2>Nittoz</h2>
    @if ($nittozReady)
      <p>Order credentials are set. You can sync products and transfer orders.</p>
    @else
      <p>Product sync works without keys. Paste App Key, App Secret and Username into <code>.env</code> only when you are ready to transfer orders to Nittoz.</p>
    @endif
    <p><a class="btn btn--small" href="{{ route('admin.nittoz') }}">Open Nittoz import</a></p>
  </section>
  <h2>Latest orders</h2>
  <table>
    <tr><th>Order</th><th>Customer</th><th>Total</th><th>Status</th></tr>
    @forelse ($recent as $order)
      <tr>
        <td><a href="{{ route('admin.orders.show', $order) }}">{{ $order->order_no }}</a></td>
        <td>{{ $order->name }}<br><span class="muted">{{ $order->phone }}</span></td>
        <td>৳{{ number_format($order->total) }}</td>
        <td>{{ ucfirst($order->status) }}</td>
      </tr>
    @empty
      <tr><td colspan="4">No orders yet.</td></tr>
    @endforelse
  </table>
  @if ($messages)<p style="margin-top:12px"><a href="{{ route('admin.messages.index') }}">{{ $messages }} unread message(s)</a></p>@endif
@endsection

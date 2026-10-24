@extends('admin.layout')
@section('title', 'Orders')
@section('content')
  <form method="GET" class="row">
    <label>Status
      <select name="status" onchange="this.form.submit()">
        <option value="">All</option>
        @foreach (['pending', 'confirmed', 'transferred', 'failed', 'cancelled'] as $value)
          <option value="{{ $value }}" @selected($status === $value)>{{ ucfirst($value) }}</option>
        @endforeach
      </select>
    </label>
  </form>
  <table>
    <tr><th>Order</th><th>Customer</th><th>Total</th><th>Status</th><th>Placed</th></tr>
    @forelse ($orders as $order)
      <tr>
        <td><a href="{{ route('admin.orders.show', $order) }}">{{ $order->order_no }}</a></td>
        <td>{{ $order->name }}<br><span class="muted">{{ $order->phone }}</span></td>
        <td>৳{{ number_format($order->total) }}</td>
        <td>{{ ucfirst($order->status) }}</td>
        <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
      </tr>
    @empty
      <tr><td colspan="5">No orders yet.</td></tr>
    @endforelse
  </table>
  <div class="pager">{{ $orders->links() }}</div>
@endsection

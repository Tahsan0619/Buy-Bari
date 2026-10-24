@extends('admin.layout')
@section('title', 'Products')
@section('content')
  <div class="row">
    <p class="muted">Local products and products imported from Nittoz.</p>
    <a class="btn" href="{{ route('admin.products.create') }}">Add product</a>
  </div>
  <table>
    <tr><th></th><th>Name</th><th>Category</th><th>Price</th><th>Nittoz id</th><th>Section</th><th></th></tr>
    @foreach ($products as $product)
      <tr>
        <td><img class="thumb" src="{{ $product->imageUrl() }}" alt="" /></td>
        <td>{{ $product->name }}<br><span class="muted">{{ $product->slug }}</span></td>
        <td>{{ $product->category?->name }}</td>
        <td>৳{{ number_format($product->price) }}</td>
        <td>{{ $product->b_product_id ?: '-' }}</td>
        <td>{{ $product->section }}{{ $product->is_active ? '' : ' (hidden)' }}</td>
        <td>
          <a class="btn btn--ghost btn--small" href="{{ route('admin.products.edit', $product) }}">Edit</a>
          <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display:inline" onsubmit="return confirm('Delete this product?')">
            @csrf @method('DELETE')
            <button class="btn btn--ghost btn--small" type="submit">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </table>
  <div class="pager">{{ $products->links() }}</div>
@endsection

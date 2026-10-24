@extends('admin.layout')
@section('title', 'Add variable Nittoz product')
@section('content')
  <p class="muted">This product has variants. Check each color, size, SKU and price. You can send variant_sku later when the order is transferred.</p>
  @include('admin.products.nittoz-form', ['showVariants' => true])
@endsection

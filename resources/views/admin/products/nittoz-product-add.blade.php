@extends('admin.layout')
@section('title', 'Add Nittoz product')
@section('content')
  <p class="muted">Review the simple product, fill anything Nittoz left blank, then save it. If this Nittoz id is already in the shop it will not be added again.</p>
  @include('admin.products.nittoz-form')
@endsection

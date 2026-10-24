@extends('admin.layout')
@section('title', $product->exists ? 'Edit product' : 'Add product')
@section('content')
  <form class="panel" method="POST" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf
    @if ($product->exists) @method('PUT') @endif
    <div class="grid-2">
      <label>Name<input name="name" value="{{ old('name', $product->name) }}" required /></label>
      <label>Slug<input name="slug" value="{{ old('slug', $product->slug) }}" placeholder="Leave blank to generate" /></label>
      <label>Category
        <select name="category_id" required>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
          @endforeach
        </select>
      </label>
      <label>Section
        <select name="section">
          @foreach (['hot' => 'Hot', 'discount' => 'Discount', 'new' => 'New', 'regular' => 'Regular'] as $value => $label)
            <option value="{{ $value }}" @selected(old('section', $product->section) === $value)>{{ $label }}</option>
          @endforeach
        </select>
      </label>
      <label>Price<input type="number" name="price" min="0" value="{{ old('price', $product->price) }}" required /></label>
      <label>Old price<input type="number" name="old_price" min="0" value="{{ old('old_price', $product->old_price) }}" /></label>
      <label>Badge
        <select name="badge">
          @foreach (['hot' => 'Hot', 'discount' => 'Discount', 'new' => 'New', 'feature' => 'Feature'] as $value => $label)
            <option value="{{ $value }}" @selected(old('badge', $product->badge) === $value)>{{ $label }}</option>
          @endforeach
        </select>
      </label>
      <label>Rating<input type="number" name="rating" min="1" max="5" value="{{ old('rating', $product->rating ?: 5) }}" /></label>
      <label>Reviews<input type="number" name="reviews" min="0" value="{{ old('reviews', $product->reviews) }}" /></label>
      <label>Image path or URL<input name="image" value="{{ old('image', $product->image) }}" placeholder="/images/products/vase-set.jpg" /></label>
    </div>
    <label>Upload a new image<input type="file" name="image_file" accept="image/*" /></label>
    <label>Description<textarea name="description" rows="4">{{ old('description', $product->description) }}</textarea></label>
    <label class="check"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active)) /> Visible in the shop</label>
    @if ($product->b_product_id)<p class="muted">Linked Nittoz product id: {{ $product->b_product_id }}</p>@endif
    <button class="btn" type="submit">Save product</button>
  </form>
@endsection

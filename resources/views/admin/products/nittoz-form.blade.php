<form class="panel" method="POST" action="{{ route('admin.nittoz.import') }}">
  @csrf
  <div class="grid-2">
    <label>Name<input name="name" value="{{ old('name', $preview['name']) }}" required /></label>
    <label>Nittoz id<input value="{{ $preview['b_product_id'] }}" disabled /></label>
    <label>Price<input type="number" name="price" min="0" value="{{ old('price', $preview['price']) }}" required /></label>
    <label>Old price<input type="number" name="old_price" min="0" value="{{ old('old_price', $preview['old_price']) }}" /></label>
    <label>Category
      <select name="category_id" required>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" @selected(old('category_id') == $category->id || $category->name === ($preview['category'] ?? ''))>{{ $category->name }}</option>
        @endforeach
      </select>
    </label>
    <label>Image URL<input name="image" value="{{ old('image', $preview['image']) }}" /></label>
  </div>
  @if ($preview['image'])<p><img class="thumb" src="{{ $preview['image'] }}" alt="" /></p>@endif
  <label>Description<textarea name="description" rows="4">{{ old('description', $preview['description']) }}</textarea></label>
  @if (!empty($showVariants))
    <h3>Variants</h3>
    <table>
      <tr><th>SKU</th><th>Color</th><th>Size</th><th>Price</th><th>Image</th></tr>
      @forelse ($preview['variants'] as $i => $variant)
        <tr>
          <td><input name="variants[{{ $i }}][sku]" value="{{ $variant['sku'] }}" /></td>
          <td><input name="variants[{{ $i }}][color]" value="{{ $variant['color'] }}" /></td>
          <td><input name="variants[{{ $i }}][size]" value="{{ $variant['size'] }}" /></td>
          <td><input type="number" name="variants[{{ $i }}][price]" value="{{ $variant['price'] }}" /></td>
          <td><input name="variants[{{ $i }}][image]" value="{{ $variant['image'] }}" /></td>
        </tr>
      @empty
        <tr>
          <td><input name="variants[0][sku]" placeholder="SKU if you have it" /></td>
          <td><input name="variants[0][color]" placeholder="Color" /></td>
          <td><input name="variants[0][size]" placeholder="Size" /></td>
          <td><input type="number" name="variants[0][price]" value="{{ $preview['price'] }}" /></td>
          <td><input name="variants[0][image]" /></td>
        </tr>
      @endforelse
    </table>
  @endif
  <p style="margin-top:14px"><button class="btn" type="submit">Add to shop</button></p>
</form>

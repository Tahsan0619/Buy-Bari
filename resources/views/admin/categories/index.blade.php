@extends('admin.layout')
@section('title', 'Categories')
@section('content')
  <form class="panel" method="POST" action="{{ route('admin.categories.store') }}">
    @csrf
    <div class="grid-2">
      <label>Name<input name="name" required /></label>
      <label>Icon name<input name="icon" value="grid" required /></label>
      <label>Sort<input type="number" name="sort" value="0" min="0" /></label>
    </div>
    <button class="btn" type="submit">Add category</button>
  </form>
  <table style="margin-top:16px">
    <tr><th>Name</th><th>Icon</th><th>Products</th><th>Sort</th><th></th></tr>
    @foreach ($categories as $category)
      <tr>
        <td colspan="5">
          <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="grid-2">
            @csrf @method('PUT')
            <input name="name" value="{{ $category->name }}" />
            <input name="icon" value="{{ $category->icon }}" />
            <input type="number" name="sort" value="{{ $category->sort }}" />
            <span class="muted">{{ $category->products_count }} products</span>
            <button class="btn btn--small" type="submit">Save</button>
          </form>
          <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Delete this category?')">
            @csrf @method('DELETE')
            <button class="btn btn--ghost btn--small" type="submit">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </table>
@endsection

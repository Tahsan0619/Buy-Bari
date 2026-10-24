@extends('admin.layout')
@section('title', 'Banners')
@section('content')
  <p class="muted">Plain banners are full artwork, like the two client designs. Leave the text fields empty for those.</p>
  @foreach ($banners as $banner)
    <form class="panel" method="POST" action="{{ route('admin.banners.update', $banner) }}" enctype="multipart/form-data" style="margin-bottom:14px">
      @csrf @method('PUT')
      <div class="row">
        <img class="thumb" src="{{ $banner->imageUrl() }}" alt="" style="width:140px;height:70px" />
        <button class="btn btn--small" type="submit">Save</button>
      </div>
      <div class="grid-2">
        <label>Image path<input name="image" value="{{ $banner->image }}" /></label>
        <label>Replace file<input type="file" name="image_file" accept="image/*" /></label>
        <label>Alt text<input name="alt" value="{{ $banner->alt }}" /></label>
        <label>Link<input name="link" value="{{ $banner->link }}" /></label>
        <label>Sort<input type="number" name="sort" value="{{ $banner->sort }}" /></label>
        <label class="check"><input type="checkbox" name="plain" value="1" @checked($banner->plain) /> Full artwork, no text overlay</label>
        <label class="check"><input type="checkbox" name="is_active" value="1" @checked($banner->is_active) /> Show on the homepage</label>
      </div>
    </form>
    <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}" onsubmit="return confirm('Delete this banner?')" style="margin:-8px 0 18px">
      @csrf @method('DELETE')
      <button class="btn btn--ghost btn--small" type="submit">Delete</button>
    </form>
  @endforeach

  <h2>Add a banner</h2>
  <form class="panel" method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="grid-2">
      <label>Image path<input name="image" placeholder="/images/banners/client-1.jpeg" /></label>
      <label>Or upload<input type="file" name="image_file" accept="image/*" /></label>
      <label>Alt text<input name="alt" /></label>
      <label>Link<input name="link" value="/#products" /></label>
      <label>Sort<input type="number" name="sort" value="{{ $banners->count() + 1 }}" /></label>
    </div>
    <label class="check"><input type="checkbox" name="plain" value="1" checked /> Full artwork, no text overlay</label>
    <label class="check"><input type="checkbox" name="is_active" value="1" checked /> Show on the homepage</label>
    <button class="btn" type="submit">Add banner</button>
  </form>
@endsection

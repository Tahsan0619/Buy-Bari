@extends('admin.layout')
@section('title', 'Settings')
@section('content')
  <form class="panel" method="POST" action="{{ route('admin.settings.update') }}">
    @csrf @method('PUT')
    <div class="grid-2">
      @foreach ([
        'name' => 'Shop name',
        'phone' => 'Phone',
        'phone_link' => 'Phone link',
        'whatsapp' => 'WhatsApp number',
        'email' => 'Email',
        'address' => 'Address',
        'facebook' => 'Facebook URL',
        'hours' => 'Support hours',
        'delivery_inside' => 'Delivery inside Dhaka',
        'delivery_outside' => 'Delivery outside Dhaka',
        'logo' => 'Logo path',
      ] as $key => $label)
        <label>{{ $label }}<input name="{{ $key }}" value="{{ old($key, $values[$key]) }}" required /></label>
      @endforeach
    </div>
    <label>Tagline<textarea name="tagline" rows="3" required>{{ old('tagline', $values['tagline']) }}</textarea></label>
    <button class="btn" type="submit">Save settings</button>
  </form>
  <section class="panel" style="margin-top:16px">
    <h2>Nittoz</h2>
    <p>{{ $nittozReady ? 'Credentials are configured.' : 'Credentials are still placeholders. Edit them in the .env file.' }}</p>
  </section>
@endsection

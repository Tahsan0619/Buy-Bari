<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Admin') | Buybari</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" href="/images/favicon.png" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/css/admin.css" />
</head>
<body>
  <aside class="side">
    <a class="side__logo" href="{{ route('admin.dashboard') }}"><img src="/images/logo.png" alt="Buybari" /></a>
    <nav>
      <a href="{{ route('admin.dashboard') }}" @class(['is-active' => request()->routeIs('admin.dashboard')])>Dashboard</a>
      <a href="{{ route('admin.products.index') }}" @class(['is-active' => request()->routeIs('admin.products.*')])>Products</a>
      <a href="{{ route('admin.nittoz') }}" @class(['is-active' => request()->routeIs('admin.nittoz*')])>Nittoz import</a>
      <a href="{{ route('admin.categories.index') }}" @class(['is-active' => request()->routeIs('admin.categories.*')])>Categories</a>
      <a href="{{ route('admin.banners.index') }}" @class(['is-active' => request()->routeIs('admin.banners.*')])>Banners</a>
      <a href="{{ route('admin.orders.index') }}" @class(['is-active' => request()->routeIs('admin.orders.*')])>Orders</a>
      <a href="{{ route('admin.messages.index') }}" @class(['is-active' => request()->routeIs('admin.messages.*')])>Messages</a>
      <a href="{{ route('admin.settings.edit') }}" @class(['is-active' => request()->routeIs('admin.settings.*')])>Settings</a>
      <a href="{{ route('home') }}" target="_blank" rel="noreferrer">View shop</a>
    </nav>
    <form method="POST" action="{{ route('admin.logout') }}">@csrf<button type="submit">Log out</button></form>
  </aside>
  <main class="main">
    <header class="top"><h1>@yield('title')</h1></header>
    @if (session('status'))<p class="alert alert--ok">{{ session('status') }}</p>@endif
    @if ($errors->any())<div class="alert alert--bad">@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
    @yield('content')
  </main>
</body>
</html>

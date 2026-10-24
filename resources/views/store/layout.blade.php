<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $title }}</title>
  <meta name="description" content="Buybari: shop home decor, kitchen, gadgets, fashion and food online with delivery all over Bangladesh and cash on delivery." />
  <meta name="theme-color" content="#e31e24" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" href="/images/favicon.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Roboto:wght@400;500;700&family=Hind+Siliguri:wght@400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/css/style.css" />
</head>
<body data-page="{{ $page }}">
  @yield('content')

  <script>
    window.BUYBARI_CATALOG = @json($catalog);
    window.BUYBARI_PAGES = @json($pages);
    window.BUYBARI_PRODUCT_ID = @json($productId);
  </script>
  <script src="/js/data.js"></script>
  <script src="/js/layout.js"></script>
  <script src="/js/app.js"></script>
</body>
</html>

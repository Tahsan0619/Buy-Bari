<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin login | Buybari</title>
  <link rel="icon" href="/images/favicon.png" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/css/admin.css" />
</head>
<body class="login-body">
  <form class="login" method="POST" action="{{ route('admin.login.submit') }}">
    @csrf
    <img src="/images/logo.png" alt="Buybari" />
    <h1>Admin login</h1>
    <p>Sign in to manage products, orders and Nittoz.</p>
    @if ($errors->any())<p class="alert alert--bad">{{ $errors->first() }}</p>@endif
    <label>Email<input type="email" name="email" value="{{ old('email') }}" required autofocus /></label>
    <label>Password<input type="password" name="password" required /></label>
    <label class="check"><input type="checkbox" name="remember" value="1" /> Remember me</label>
    <button type="submit">Sign in</button>
  </form>
</body>
</html>

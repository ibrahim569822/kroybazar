<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KroyBazar Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container" style="max-width: 400px;">
    <h2 class="mt-5 mb-4">KroyBazar Login</h2>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <input class="form-control mb-3" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
        <input class="form-control mb-3" type="password" name="password" placeholder="Password">
        <button class="btn btn-dark w-100">Login</button>
    </form>
</div>
</body>
</html>
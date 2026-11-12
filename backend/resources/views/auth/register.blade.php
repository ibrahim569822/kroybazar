<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="robots" content="noindex, nofollow">
<title>Sign Up - KroyBazar</title>

<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.jpg') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="account-page">

<div class="main-wrapper">
<div class="account-content">
<div class="login-wrapper">
<div class="login-content">
<div class="login-userset">

<div class="login-logo">
<h2 class="text-center" style="color:#ff9f43; font-weight:700;">KroyBazar</h2>
</div>

<div class="login-userheading">
<h3>Create an Account</h3>
<h4>Continue to KroyBazar</h4>
</div>

@if ($errors->any())
<div class="alert alert-danger">
@foreach ($errors->all() as $error)
<div>{{ $error }}</div>
@endforeach
</div>
@endif

<form method="POST" action="/register">
@csrf

<div class="form-login">
<label>Account Type</label>
<select name="role" class="form-select">
<option value="3" {{ old('role') == 3 ? 'selected' : '' }}>Shop Owner</option>
<option value="2" {{ old('role') == 2 ? 'selected' : '' }}>Warehouse</option>
</select>
</div>

<div class="form-login">
<label>Business Name</label>
<div class="form-addons">
<input type="text" name="business_name" value="{{ old('business_name') }}" placeholder="Shop or warehouse name">
</div>
</div>

<div class="form-login">
<label>Your Name</label>
<div class="form-addons">
<input type="text" name="name" value="{{ old('name') }}" placeholder="Enter your name">
</div>
</div>

<div class="form-login">
<label>Email</label>
<div class="form-addons">
<input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address">
<img src="{{ asset('assets/img/icons/mail.svg') }}" alt="img">
</div>
</div>

<div class="form-login">
<label>Password</label>
<div class="pass-group">
<input type="password" name="password" class="pass-input" placeholder="At least 8 characters">
<span class="fas toggle-password fa-eye-slash"></span>
</div>
</div>

<div class="form-login">
<label>Confirm Password</label>
<div class="pass-group">
<input type="password" name="password_confirmation" class="pass-input" placeholder="Type the password again">
<span class="fas toggle-password fa-eye-slash"></span>
</div>
</div>

<div class="form-login">
<button type="submit" class="btn btn-login">Sign Up</button>
</div>

</form>

<div class="signinform text-center">
<h4>Already have an account? <a href="/login" class="hover-a">Sign In</a></h4>
</div>

</div>
</div>
<div class="login-img">
<img src="{{ asset('assets/img/login.jpg') }}" alt="img">
</div>
</div>
</div>
</div>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
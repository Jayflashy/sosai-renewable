@extends('layouts.auth')
@section('title', 'Admiin Login')
@section('content')
@include('alerts.alerts')
<form class="js-validation-signin" action="{{route('login')}}" method="POST">
  @csrf
  <div class="mb-4">
      <label for="" class="form-label">Email or Username</label>
    <div class="input-group input-group-lg">
      <input type="text" class="form-control" id="username" name="username" value="{{ old('email') }}" placeholder="Email or Username" required>
      <span class="input-group-text">
        <i class="fa fa-user-circle"></i>
      </span>
    </div>
  </div>
  <div class="mb-4">
      <label for="" class="form-label">Password</label>
    <div class="input-group input-group-lg">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
      <span class="input-group-text">
        <i class="fa fa-lock"></i>
      </span>
    </div>
  </div>
  <div class="d-sm-flex justify-content-sm-between align-items-sm-center text-center text-sm-start mb-4">
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="login-remember-me" name="remember" {{ old('remember') ? 'checked' : '' }}>
      <label class="form-check-label" for="login-remember-me">Remember Me</label>
    </div>
    <div class="fw-semibold fs-sm py-1">
      <a href="{{ route('password.request') }}">Forgot Password?</a>
    </div>
  </div>
  <div class="text-center mb-4">
    <button type="submit" class="btn btn-hero btn-primary">
      <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> Sign In
    </button>
  </div>
</form>

@endsection

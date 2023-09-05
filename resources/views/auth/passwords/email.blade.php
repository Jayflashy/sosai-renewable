@extends('layouts.auth')
@section('title', 'Reset Password')
@section('content')
@include('alerts.alerts')
<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="row mb-3">
        <label for="email" class="form-label">{{ __('Email Address') }}</label>

        <div class="">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="text-center mb-4">
        <button type="submit" class="btn btn-primary btn-block">
            {{ __('Send Password Reset Link') }}
        </button>
    </div>
</form>
@endsection

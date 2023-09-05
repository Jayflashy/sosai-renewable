@extends('errors.layouts')
@section('title', "Internal Server Error")
@section('content')
<div class="col-lg-12">
    <div class="text-center my-5">
        <h1 class="fw-bold text-error">5 <span class="error-text">0<img src="{{static_asset('img/error-img.png')}}" alt="error-img" class="error-img"></span> 0</h1>
        <h3 class="text-uppercase">Internal Server Error</h3>
        <div class="mt-5 text-center">
            <a class="btn btn-primary waves-effect waves-light" href="{{route('index')}}">Back to Homepage</a>
        </div>
    </div>
</div>
@endsection
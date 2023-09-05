@extends('layouts.auth')
@section('title', 'Registration')
@section('content')
@include('alerts.alerts')
<form class="js-validation-signin" action="{{route('register')}}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="" class="form-label">Full Name</label>
        <div class="input-group input-group-lg">
          <input type="text" class="form-control" value="{{ old('name') }}"  id="name" required name="name" placeholder="Full Name">
          <span class="input-group-text">
            <i class="fa fa-user-circle"></i>
          </span>
        </div>
    </div>
    <div class="mb-4">
        <label for="" class="form-label">Username</label>
        <div class="input-group input-group-lg">
          <input type="text" class="form-control" value="{{ old('username') }}"  id="username" required name="username" placeholder="Username">
          <span class="input-group-text">
            <i class="fa fa-user-circle"></i>
          </span>
        </div>
    </div>
    <div class="mb-4">
        <label for="" class="form-label">Email</label>
        <div class="input-group input-group-lg">
          <input type="email" class="form-control" value="{{ old('email') }}" id="email" required name="email" placeholder="Email">
          <span class="input-group-text">
            <i class="fa fa-envelope-open"></i>
          </span>
        </div>
    </div>
    <div class="mb-4">
        <label for="" class="form-label">Phone Number</label>
        <div class="input-group input-group-lg">
          <input type="text" class="form-control" value="{{ old('phone') }}" id="phone" required name="phone" placeholder="Phone Number">
          <span class="input-group-text">
            <i class="fa fa-phone"></i>
          </span>
        </div>
    </div>
    <div class="mb-4">
        <label for="" class="form-label">State</label>
        <div class="input-group input-group-lg">
          <input type="text" class="form-control" value="{{ old('state') }}" required name="state" placeholder="State of Residence">
          <span class="input-group-text">
            <i class="far fa-map"></i>
          </span>
        </div>
    </div>
    <div class="mb-4">
        <label for="" class="form-label">Address</label>
        <div class="input-group input-group-lg">
          <input type="text" class="form-control" value="{{ old('address') }}" id="address" required name="address" placeholder="House Address">
          <span class="input-group-text">
            <i class="fa fa-map-marker-alt"></i>
          </span>
        </div>
    </div>
    {{-- <div class="mb-4">
        <label for="" class="form-label">Meter Type</label>
        <div class="payments mb-2">
          <small class="smalls mt-0">Select the image below that best represent your meter type</small>
          <hr class="my-0">
          <div class="row mx-auto">
            <div class="col-6">
              <label class="mb-2 pay-option" data-toggle="tooltip" data-title="Angaza">
                <input type="radio" id="" name="acc_type" value="angaza">  
                <span>
                    <img class="pay-method" src="{{static_asset('img/angaza.jpg')}}" >
                </span>                              
              </label>
            </div>
            <div class="col-6">
              <label class="mb-2 pay-option" data-toggle="tooltip" data-title="Steama Payment">
                <input type="radio" id="" name="acc_type" value="steama">  
                <span>
                    <img class="pay-method" src="{{static_asset('img/steamaco.jpg')}}" >
                </span>                              
              </label>
            </div>
          </div>
        </div>
    </div> --}}
    <div class="mb-4">
      <label for="" class="form-label">Meter Number</label>
      <div class="input-group input-group-lg">
        <input type="text" class="form-control" value="{{ old('meter') }}" id="meter" required name="meter" placeholder="Meter Number">
        <span class="input-group-text">
          <i class="fa fa-file"></i>
        </span>
      </div>
    </div>
    <div class="mb-4">
        <label for="" class="form-label">Password</label>
        <div class="input-group input-group-lg">
          <input type="password" class="form-control" id="password" required name="password" placeholder="Password">
          <span class="input-group-text">
            <i class="fa fa-lock"></i>
          </span>
        </div>
    </div>
    <div class="d-sm-flex justify-content-sm-between align-items-sm-center text-center text-sm-start mb-4">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="terms" required name="terms">
          <label class="form-check-label" for="signup-terms">Agree to our Terms and Conditions </label>
        </div>
    </div>
    <div class="text-center mb-4">
      <button type="submit" class="btn btn-hero btn-primary">
        <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> Sign Up
      </button>
    </div>
    
    <div class="d-sm-flex justify-content-sm-between align-items-sm-center text-center text-sm-start mb-4">
        <div class="">
          <span>Already have an Account?</span>
        </div>
        <div class="fw-semibold fs-sm ">
          <a href="{{ route('login') }}" class="btn btn-primary">Sign IN</a>
        </div>
    </div>
</form>

@endsection

@section('styles')
<style>
  .smalls {
    font-size: 0.775em;
  }

  .payments>hr {
      margin-bottom: 0;
      margin-top: 0;
  }

  .pay-option {
      position: relative;
      cursor: pointer;
  }

  label.pay-option input {
      opacity: 0;
      /*position: fixed;*/
  }

  label.pay-option {
      position: relative;
      cursor: pointer;
  }

  label.pay-option span {
      display: inline-block;
      border-radius: 9px;
      background: #f6f6f6;
      position: relative;
  }

  .pay-method {
      display: block;
      width: 100%;
  }

  label.pay-option input:checked+span:before {
      position: absolute;
      height: 100%;
      width: 100%;
      background: rgba(255, 255, 255, 0.433);
      content: "";
      top: 0;
      left: 0;
  }

  label.pay-option input:checked+span:after {
      position: absolute;
      content: "";
      left: calc(50% - 6px);
      top: calc(50% - 12px);
      width: 12px;
      height: 24px;
      border: solid #28a745;
      border-width: 0 4px 4px 0;
      -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      transform: rotate(45deg);
      box-shadow: 2px 3px 5px rgb(94, 146, 106);
  }
</style>
@endsection
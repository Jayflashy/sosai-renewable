@extends('agent.layouts.master')
@section('title', "Account Setting")

@section('content')
<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body text-center border-bottom">
                <img class="profile-image" src="{{(Auth::user()->image != null) ?my_asset(Auth::user()->image) : static_asset('img/profile.jpg')}}" alt="">
                <h5 class="card-title mt-3">{{ Auth::user()->name }}</h5>
            </div>
            <div class="card-body">
                <p class="clearfix">
                    <span class="float-start">Username</span>
                    <span class="float-end font-weight-bold"><a href="#">{{ Auth::user()->username }}</a></span>
                </p>
                <p class="clearfix">
                    <span class="float-start">Email</span>
                    <span class="float-end text-muted">{{ Auth::user()->email }}</span>
                </p>
                <p class="clearfix">
                    <span class="float-start">Phone</span>
                    <span class="float-end text-muted">{{ Auth::user()->phone ?: 'Not available'}}</span>
                </p>
                {{-- <p class="clearfix">
                    <span class="float-start">Meter Type</span>
                    <span class="float-end ">
                        <span class="badge bg-info"> {{ Auth::user()->acc_type ?: 'Not available'}}</span>
                    </span>
                </p>
                <p class="clearfix">
                    <span class="float-start">Meter Number</span>
                    <span class="float-end fw-bold">{{ Auth::user()->meter ?: 'Not available'}}</span>
                </p> --}}

                <p class="clearfix">
                    <span class="float-start">Balance</span>
                    <span class="float-end text-muted">{{ format_price(Auth::user()->balance) }}</span>
                </p>
                <p class="clearfix">
                    <span class="float-start">Date Joined</span>
                    <span class="float-end text-muted">{{show_datetime(Auth::user()->created_at)}}</span>
                </p>

                <p class="clearfix">
                    <span class="float-start">Status</span>
                    <span class="float-end text-muted">
                        @if(Auth::user()->status == 1)
                        <span class="badge badge-pill bg-success">Verified</span> @elseif(Auth::user()->status == 2)
                        <span class="badge badge-pill bg-warning">Unverified</span> @else
                        <span class="badge badge-pill bg-danger">Deactivated</span>
                        @endif
                    </span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST" class="row" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-6">
                        <label class="form-label" for="name">@lang('Name')</label>
                        <input type="text" placeholder="@lang('Name')" id="name" name="name" class="form-control" value="{{Auth::user()->name}}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="email">@lang('Email Address')</label>
                        <input type="text" placeholder="@lang('Email Address')" id="email" class="form-control" value="{{Auth::user()->email}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" >@lang('Username')</label>
                        <input type="text" placeholder="@lang('Username')" readonly class="form-control" value="{{Auth::user()->username}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" >@lang('Phone')</label>
                        <input type="text" placeholder="@lang('Phone')" name="phone" class="form-control" value="{{Auth::user()->phone}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" >Address</label>
                        <input type="text" placeholder="Address" name="address" class="form-control" value="{{Auth::user()->address}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" >State</label>
                        <input type="text" placeholder="State" name="state" class="form-control" value="{{Auth::user()->state}}">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="form-label" >Profile Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" onchange="preview_picture(event)">
                        <img id="pimage" class="col-md-6 d-none kyc-image"/>
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-block btn-primary w-100">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- USer Password -->
        <div class="card user-data-card mt-3">
            <h5 class="card-header">Change Password</h5>
            <div class="card-body">
                <form action="{{route('user.password.update')}}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Old Password</label>
                        <div class="position-relative">
                            <input class="form-control" id="psw-input" required name="old_password" type="password" placeholder="Enter Password">
                            <div class="position-absolute" id="password-visibility"><i class="bi bi-eye"></i><i class="bi bi-eye-slash"></i></div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">New Password</label>
                        <div class="position-relative">
                            <input class="form-control" id="psw-input1" required name="new_password" type="password" placeholder="Enter Password">
                            <div class="position-absolute" id="password-visibility1"><i class="bi bi-eye"></i><i class="bi bi-eye-slash"></i></div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-success w-100">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('breadcrumb')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">@yield('title')</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Agent</a></li>
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
@endsection
@section('styles')
<style>
    .profile-image{
        position: inherit;
        width: 100%;
    }
    .kyc-image{
        height: 200px;
        width:auto;
    }
</style>
@endsection
@section('scripts')
<script>
    function preview_picture(event)
    {
        document.getElementById('pimage').classList.remove('d-none');
        var reader = new FileReader();
        reader.onload = function()
        {
            var output = document.getElementById('pimage');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection

@extends('admin.layouts.master')
@section('title', 'Create Agent')

@section('content')

<div class="row justify-content-center">
   
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                @include('alerts.alerts')
                <form action="{{ route('admin.agents.store') }}" method="POST" class="row">
                    @csrf
                    <div class="form-group col-md-6">
                        <label class="form-label" for="name">@lang('Agent Name')</label>
                        <input type="text" placeholder="@lang('Name')" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="email">@lang('Email Address')</label>
                        <input type="text" placeholder="@lang('Email Address')" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" >@lang('Username')</label>
                        <input type="text" placeholder="@lang('Username')" name="username" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" >@lang('Phone')</label>
                        <input type="text" placeholder="@lang('Phone')" name="phone" class="form-control" required">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" >Address</label>
                        <input type="text" placeholder="Address" name="address" class="form-control" >
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="password">@lang('Password')</label>
                        <input type="password" placeholder="@lang('Password')" id="password" name="password" class="form-control">
                    </div>
                    
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-block btn-primary w-100">@lang('Create Agent')</button>
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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
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
</style>
@endsection
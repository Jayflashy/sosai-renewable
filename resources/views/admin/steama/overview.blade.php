@extends('admin.layouts.master')
@section('title', 'Steamaco Overview')
@section('content')
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Total Meters</h4>
                <h4 class="mt-3 mb-2"><b>{{ $meters['count']}}</b></h4>
                <p class="text-muted mb-0 mt-3"></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Total Customers</h4>
                <h4 class="mt-3 mb-2 text-warning"><b>{{ $customers['count'] }}</b></h4>
                <p class="text-muted mb-0 mt-3"></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Total Agents</h4>
                <h4 class="mt-3 mb-2 text-info"><b>{{ $agents['count']}}</b></h4>
                <p class="text-muted mb-0 mt-3"></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Total Sites</h4>
                <h4 class="mt-3 mb-2 text-success"><b>{{ $sites['count'] }}</b></h4>
                <p class="text-muted mb-0 mt-3"></p>
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
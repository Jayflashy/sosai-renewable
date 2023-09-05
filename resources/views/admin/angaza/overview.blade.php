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
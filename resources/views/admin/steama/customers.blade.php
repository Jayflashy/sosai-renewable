@extends('admin.layouts.master')
@section('title', 'Steamaco Overview')
@section('content')
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover" id="datatable">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Telephone</th>
                    <th>Energy Price</th>
                    <th>Account Balance</th>
                    <th>Date Joined</th>
                    <th>Site Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers['results'] as $key => $item)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['first_name'] ??"" }} {{ $item['last_name'] ??"" }}</td>
                    <td>{{ $item['telephone'] ?? "null"}}</td>
                    <td> {{ $item['energy_price'] }} </td>
                    <td> {{ $item['account_balance'] }} </td>
                    <td> {{show_datetime($item['created']) }} </td>
                    <td>{{$item['site_name']?? "Null"}}</td>
                </tr>
                @endforeach
            </tbody>            
        </table>
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
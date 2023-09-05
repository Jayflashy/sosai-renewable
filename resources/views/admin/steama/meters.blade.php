@extends('admin.layouts.master')
@section('title', 'Steamaco Meters')
@section('content')
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover" id="datatable">
            <thead>
                <tr>
                    <th>Meter ID</th>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Meter Version</th>
                    <th>Last Meter Reading</th>
                    <th>Connection</th>
                    <th>Power Limit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($meters['results'] as $key => $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['customer'] ??"null" }}</td>
                    <td>{{ $item['customer_name'] ?? "null"}}</td>
                    <td> {{ $item['version'] }} </td>
                    <td> {{show_datetime($item['latest_meter_reading_timestamp']) }} </td>
                    <td><span class="badge @if($item['connection_is_on'] == true)bg-success @else bg-warning @endif">@if($item['connection_is_on'] == true)on @else off @endif </span></td>
                    <td>{{$item['power_limit']?? "Null"}}</td>
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
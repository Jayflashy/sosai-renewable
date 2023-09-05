@extends('admin.layouts.master')
@section('title', 'Pending Users')

@section('content')
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover" id="datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Information</th>
                    <th>Acc Type</th>
                    <th>Meter Number</th>
                    <th>Date Joined</th>
                    <th>Status </th>
                    <th>Actions </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $item)
                <tr>
                    <td>{{ $key +1 }}</td>
                    <td>
                        <p class="mb-0">Name : {{ text_trim($item->name, 25) }} </p>
                        <p class="my-0">Email : {{ $item->email }} </p>
                        <p>Username : {{ $item->username }} </p>
                    </td>
                    <td> {{ $item->acc_type }} </td>
                    <td> {{$item->meter }} </td>
                    <td>{{$item->created_at->diffForHumans()}}</td>
                    <td><span class="badge @if($item->meter_verify == 2)bg-warning @else bg-success @endif">@if($item->meter_verify == 2)pending @else approved @endif </span></td>
                    <td>
                        <div class="dropstart">
                            <button class="btn btn-light" type="button" id="" data-bs-toggle="dropdown">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('admin.users.view' ,$item->id )}}">@lang('Details')</a>
                                <a class="dropdown-item" href="{{route('admin.users.approve' ,$item->id )}}">@lang('Approve User')</a>
                            </div>
                        </div>
                    </td>
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
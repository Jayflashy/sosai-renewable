@extends('admin.layouts.master')
@section('title', 'Agent Details')

@section('content')

<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body text-center border-bottom">
                <img class="profile-image" src="{{($agent->image != null) ?my_asset($agent->image) : static_asset('img/profile.jpg')}}" alt="">
                <h5 class="card-title mt-3">{{ $agent->name }}</h5>
            </div>
            <div class="card-body">
                <p class="clearfix">
                    <span class="float-start">Username</span>
                    <span class="float-end font-weight-bold"><a href="#">{{ $agent->username }}</a></span>
                </p>
                <p class="clearfix">
                    <span class="float-start">Email</span>
                    <span class="float-end text-muted">{{ $agent->email }}</span>
                </p>
                <p class="clearfix">
                    <span class="float-start">Phone</span>
                    <span class="float-end text-muted">{{ $agent->phone ?: 'Not available'}}</span>
                </p>

                <p class="clearfix">
                    <span class="float-start">Balance</span>
                    <span class="float-end text-muted">{{ format_price($agent->balance) }}</span>
                </p>
                <p class="clearfix">
                    <span class="float-start">Joined</span>
                    <span class="float-end text-muted">{{show_datetime($agent->created_at)}}</span>
                </p>

                <p class="clearfix">
                    <span class="float-start">Status</span>
                    <span class="float-end text-muted">
                        @if($agent->suspend == 0)
                        <span class="badge badge-pill bg-success">Active</span> @else
                        <span class="badge badge-pill bg-danger">Banned</span>
                        @endif
                    </span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <div class="row p-4">
                    <div class="col-lg-4 col-sm-6">
                        <div class="card outline-dark">
                            <div class="card-body">
                                <div class="media align-items-center">
                                <div class="media-body text-start">
                                    <h4 class="mb-0 text-dark">{{ format_price($agent->deposits->sum('amount')) }}</h4>
                                    <span class="text-dark">Total Deposits</span>
                                </div>
                                {{-- <div class="align-self-center icon-lg">
                                    <i class="fas fa-money-bill text-dark"></i>
                                </div> --}}
                                </div>
                            </div>
                            <a href="{{ route('admin.agents.deposits', $agent->id) }}" class="btn btn-block btn-dark">View All
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card outline-primary">
                            <div class="card-body">
                                <div class="media align-items-center">
                                <div class="media-body text-start">
                                    <h4 class="mb-0 text-warning">{{ $agent->transactions->count()}}</h4>
                                    <span class="text-warning">Total Transactions</span>
                                </div>
                                {{-- <div class="align-self-center icon-lg d-none d-md-block">
                                    <i class="fa fa-exchange-alt text-warning"></i>
                                </div> --}}
                                </div>
                            </div>
                            <a href="{{ route('admin.agents.transactions', $agent->id) }}" class="btn-block btn btn-warning">
                                View All
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card outline-info">
                            <div class="card-body">
                                <div class="media align-items-center">
                                <div class="media-body text-start">
                                    <span class="text-info">Balance</span>
                                    <h4 class="mb-0 text-info">{{ format_price($agent->balance) }}</h4>
                                </div>
                                {{-- <div class="align-self-center icon-lg d-none d-md-block">
                                    <i class="fa fa-money text-info"></i>
                                </div> --}}
                                </div>
                            </div>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#fundwallet" class=" btn btn-block btn-info">Manage Balance
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card outline-success">
                            <div class="card-body">
                                <div class="media align-items-center">
                                <div class="media-body text-start">
                                    <h4 class="mb-0 text-success">{{ format_price($agent->transactions->where('status',1)->sum('amount'))}}</h4>
                                    {{-- <span class="text-success">Total Transactions</span> --}}
                                </div>
                                {{-- <div class="align-self-center icon-lg d-none d-md-block">
                                    <i class="fa fa-exchange-alt text-warning"></i>
                                </div> --}}
                                </div>
                            </div>
                            <a href="{{route('admin.agents.transactions', $agent->id)}}" class="btn-block btn btn-success">
                                Total Transactions
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card outline-info">
                            <div class="card-body">
                                <div class="media align-items-center">
                                <div class="media-body text-start">
                                    <span class="text-danger"></span>
                                    <h4 class="mb-0 text-info">{{ format_price($agent->transactions->where('type','angaza')->where('status','1')->sum('amount'))}}</h4>
                                </div>
                                </div>
                            </div>
                            <a href="{{route('admin.agents.transaction.type',['angaza',$agent->id])}}" class=" btn btn-block btn-info">Angaza Trx</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card outline-success">
                            <div class="card-body">
                                <div class="media align-items-center">
                                <div class="media-body text-start">
                                     <span class="text-success"></span>
                                    <h4 class="mb-0 text-success">{{ format_price($agent->transactions->where('type','steama')->where('status','1')->sum('amount'))}}</h4>
                                </div>
                                {{-- <div class="align-self-center icon-lg">
                                    <i class="fas fa-hand-holding-usd text-success"></i>
                                </div> --}}
                                </div>
                            </div>
                            <a href="{{route('admin.agents.transaction.type',['steama',$agent->id])}}" class=" btn btn-block btn-success">Steamaco Trx
                            </a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.users.update', $agent->id) }}" method="POST" class="row">
                    @csrf
                    <div class="form-group col-md-6">
                        <label class="form-label" for="name">@lang('Name')</label>
                        <input type="text" placeholder="@lang('Name')" id="name" name="name" class="form-control" value="{{$agent->name}}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="email">@lang('Email Address')</label>
                        <input type="text" placeholder="@lang('Email Address')" id="email" name="email" class="form-control" value="{{$agent->email}}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" >@lang('Username')</label>
                        <input type="text" placeholder="@lang('Username')" name="username" class="form-control" value="{{$agent->username}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" >@lang('Phone')</label>
                        <input type="text" placeholder="@lang('Phone')" name="phone" class="form-control" value="{{$agent->phone}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" >Address</label>
                        <input type="text" placeholder="Address" name="address" class="form-control" value="{{$agent->address}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="password">@lang('Password')</label>
                        <input type="password" placeholder="@lang('Password')" id="password" name="password" class="form-control">
                    </div>

                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-block btn-primary w-100">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Modal --}}
<div id="fundwallet" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><strong><i class="ti ti-wallet"></i> Fund Wallet</strong></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>

            </div>
            <div class="modal-body">
                <span class="mt-0 mb-2 fw-bold">User Balance : {{format_price($agent->balance)}}</span>
                <form method="POST" action="{{route('admin.users.balance', $agent->id)}}" enctype="multipart/form-data" >
                   @csrf
                    <input type="hidden" name="id" value="{{$agent->id}}">
                    <div class="form-group row">
                        <label class="form-label col-sm-3">Select Option</label>
                        <div class="col-sm-9">
                            <select class="form-select form-control" name="type">
                                <option value="1">Credit</option>
                                <option value="0">Debit</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-label">Amount </label>
                        <div class="col-sm-9">
                            <input type="number" name="amount" step="0.01" class="form-control" placeholder="Amount" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Message </label>
                        <input type="text" name="message" class="form-control" placeholder="Write Message to user.." required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="w-100 btn btn-primary">Update</button>
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

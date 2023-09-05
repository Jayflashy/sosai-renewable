@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')
@section('content')
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">System Balance</h4>
                <h4 class="mt-3 mb-2"><b>{{format_price($users->sum('balance'))}}</b></h4>
                <p class="text-muted mb-0 mt-3"></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Total Transactions </h4>
                <h4 class="mt-3 mb-2"><b>{{format_price($transactions->sum('amount'))}}</b></h4>
                <p class="text-muted mb-0 mt-3"> {{format_price(App\Models\Transaction::whereYear('updated_at', date('Y'))->whereMonth('updated_at', date('m'))->whereDay('updated_at', date('d'))->where('status', 1)->sum('amount'))}}</b> Today</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Angaza Transactions</h4>
                <h4 class="mt-3 mb-2 text-success"><b>{{format_price($transactions->where('type', 'angaza')->sum('amount'))}}</b></h4>
                <p class="text-muted mb-0 mt-3">{{format_price(App\Models\Transaction::whereType('angaza')->whereYear('updated_at', date('Y'))->whereMonth('updated_at', date('m'))->whereDay('updated_at', date('d'))->where('status', 1)->sum('amount'))}}</b> Today</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Steama Transactions</h4>
                <h4 class="mt-3 mb-2 text-primary"><b>{{format_price($transactions->where('type', 'steama')->sum('amount'))}}</b></h4>
                <p class="text-muted mb-0 mt-3">{{format_price(App\Models\Transaction::whereType('steama')->whereYear('updated_at', date('Y'))->whereMonth('updated_at', date('m'))->whereDay('updated_at', date('d'))->where('status', 1)->sum('amount'))}}</b> Today</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body">
                <h4 class="card-title text-muted">Total Users</h4>
                <h4 class="mt-3 mb-2"><b>{{$users->count()}}</b></h4>
                <p class="text-muted mb-0 mt-3"><b>{{(App\Models\User::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->whereDay('created_at', date('d'))->whereBlocked(0)->whereUserRole('user')->count())}}</b> Today</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body">
                <h4 class="card-title text-muted">Total Agents</h4>
                <h4 class="mt-3 mb-2"><b>{{$agents->count()}}</b></h4>
                <p class="text-muted mb-0 mt-3"><b>{{(App\Models\User::whereUserRole('agent')->whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->whereDay('created_at', date('d'))->whereBlocked(0)->whereUserRole('user')->count())}}</b> Today</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Total Deposits</h4>
                <h4 class="mt-3 mb-2"><b>{{format_price($deposit->where('status', 1)->sum('amount'))}}</b></h4>
                <p class="text-muted mb-0 mt-3"><b>{{format_price(App\Models\Deposit::whereYear('updated_at', date('Y'))->whereMonth('updated_at', date('m'))->whereDay('updated_at', date('d'))->where('status', 1)->sum('amount'))}}</b> Today</p>
            </div>
        </div>
    </div>
</div>
<div class="card mt-3">
    <h4 class="fw-bold card-header">Recent Transactions</h4>
  <div class="card-body table-responsive">
    <table class="w-100 table" id="datatable">
      <thead>
        <tr>
          <th>#</th>
          <th>User</th>
          <th>Amount</th>
          <th>Status</th>
          <th>Trx Code</th>
          <th>Name</th>
          <th>Phone Number</th>
          <th>Meter Type</th>
          <th>Meter No</th>
          <th>Date</th>
          <th>Response</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($trx as $key=> $item)
          <tr>
            <td>{{$key +1 }}</td>
            <td>{{$item->user->username}}</td>
            <td>{{format_price($item->amount) }}</td>
            <td>
              @if($item->status == 1)
                  <span class="badge bg-success">successful</span>
              @elseif ($item->status == 2)
                  <span class="badge bg-warning">pending</span>
              @elseif ($item->status == 3)
                  <span class="badge bg-danger">failed</span>
              @endif        
            </td>
            <td>{{$item->code}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->phone}}</td>
            <td><span class="badge bg-info"> {{$item->type}} </span></td>
            <td>{{$item->meter}}</td>
            <td>{{show_datetime($item->updated_at)}}</td>
            <td>
              <a class="btn btn-primary btn-sm btn-circle"  data-bs-toggle="modal" data-bs-target="#TrxResponse{{$item->id}}" title="@lang('Response') ">
                View
              </a> 
            </td>
          </tr>
          <div class="modal fade" id="TrxResponse{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h6 class="modal-title" id="myModalLabel"> Transaction Response</h6>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body row">
                    <p class="col-12">{{$item->response}} </p>
                  </div>
              </div>
            </div>
          </div>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
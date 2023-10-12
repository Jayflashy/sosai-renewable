@extends('app.agent.layouts.master')
@section('title', "Dashboard")

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <h4 class="card-title text-muted">Total Deposits</h4>
                <h5 class="mt-3 mb-2"><b>{{format_price(Auth::user()->deposits->sum('amount'))}}</b></h5>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Angaza Balance</h4>
                <h5 class="mt-3 mb-2"><b>{{format_price(Auth::user()->balance)}}</b></h5>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Wallet Balance</h4>
                <h5 class="mt-3 mb-2"><b>{{format_price(Auth::user()->balance)}}</b></h5>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Angaza Transactions</h4>
                <h5 class="mt-3 mb-2"><b>{{ format_price(Auth::user()->transactions->where('type','angaza')->where('status','1')->sum('amount'))}}</b></h5>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Steamaco Transactions</h4>
                <h5 class="mt-3 mb-2"><b>{{ format_price(Auth::user()->transactions->where('type','steama')->where('status','1')->sum('amount'))}}</b></h5>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">All Transactions</h4>
                <h5 class="mt-3 mb-2"><b>{{ format_price(Auth::user()->transactions->sum('amount'))}}</b></h5>
            </div>
        </div>
    </div>
</div>
<div class="row">

</div>
<div class="card mt-3">
    <div class="card-body table-responsive">
        <h4 class="fw-bold card-title">Recent Transactions</h4>
      <table class="w-100 table " id="datatable">
        <thead>
          <tr>
            <th>#</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Trx Code</th>
            <th>Name</th>
            <th>Meter</th>
            <th>Date</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($transactions as $key=> $item)
            <tr>
              <td>{{$key +1 }}</td>
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
              <td>{{$item->meter}}</td>
              <td>{{show_datetime($item->updated_at)}}</td>
              <td>{{$item->message}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection

@extends('app.user.layouts.master')
@section('title', "Dashboard")

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <h4 class="card-title text-muted">Meter Number</h4>
                <h2 class="mt-3 mb-2"><b>{{Auth::user()->meter}}</b>
                </h2>
            </div>
        </div>
    </div>
    <div class="col-sm-6 ">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Wallet Balance</h4>
                <h2 class="mt-3 mb-2"><b>{{format_price(Auth::user()->balance)}}</b></h2>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Account Type</h4>
                @if (Auth::user()->meter_verify != 1)
                <h2 class="mt-3 mb-2 btn btn-sm btn-info"><b>Verifying Meter</b></h2>
                @else
                <h2 class="mt-3 mb-2"><b>{{ Auth::user()->acc_type}}</b></h2>
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Total Transactions</h4>
                <h2 class="mt-3 mb-2"><b>{{Auth::user()->transactions->count()}}</b>
                </h2>
            </div>
        </div>
    </div>
</div>
@if(Auth::user()->meter_verify == 1 && Auth::user()->user_role == 'user')
    @if(Auth::user()->acc_type == "angaza")
        @php
        $angaza = new App\Utility\AngazaApi();
        $meter = $angaza->getAccountDetails(Auth::user()->meter);
        $customer = $angaza->getClientDetails($meter['client_qids'][0]);
        @endphp
        <h5 class="fw-bold">Meter Information</h5>
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="card text-center">
                    <div class="card-body p-t-10">
                        <h4 class="card-title text-muted mb-0">Customer Name</h4>
                        <h4 class="mt-3 mb-2"><b>{{$customer['name']}}</b>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card text-center">
                    <div class="card-body p-t-10">
                        <h4 class="card-title text-muted mb-0">Total Amount</h4>
                        <h4 class="mt-3 mb-2"><b>{{format_price($meter['full_price'])}}</b>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card text-center">
                    <div class="card-body p-t-10">
                        <h4 class="card-title text-muted mb-0">Amount Paid</h4>
                        <h4 class="mt-3 mb-2"><b>{{format_price($meter['total_paid'])}}</b>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card text-center">
                    <div class="card-body p-t-10">
                        <h4 class="card-title text-muted mb-0">Amount Remaining</h4>
                        <h4 class="mt-3 mb-2"><b>{{format_price($meter['full_price'] -$meter['total_paid'])}}</b>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card text-center">
                    <div class="card-body p-t-10">
                        <h4 class="card-title text-muted mb-0">Next Repayment</h4>
                        <h4 class="mt-3 mb-2"><b>{{show_datetime($meter['payment_due_date'])}}</b>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card text-center">
                    <div class="card-body p-t-10">
                        <h4 class="card-title text-muted mb-0">Next Repayment Amount</h4>
                        <h4 class="mt-3 mb-2"><b>{{format_price($meter['payment_amount_per_period'])}}</b>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(Auth::user()->acc_type == "steama")
        @php
        $steama = new App\Utility\SteamaApi();
        $meter = $steama->getMeterDetails(Auth::user()->meter);
        $customer = $steama->getCustomerDetails($meter['customer']);
        @endphp
        <h5 class="fw-bold">Meter Information</h5>
        <div class="row">
            <div class="col-sm-6 col-lg-6">
                <div class="card text-center">
                    <div class="card-body p-t-10">
                        <h4 class="card-title text-muted mb-0">Customer Name</h4>
                        <h4 class="mt-3 mb-2"><b>{{$meter['customer_name'] ?? "Error Getting Name"}}</b>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6">
                <div class="card text-center">
                    <div class="card-body p-t-10">
                        <h4 class="card-title text-muted mb-0">Meter Balance</h4>
                        <h4 class="mt-3 mb-2"><b>{{format_price($customer['account_balance'] ?? 0)}}</b>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
<div class="card mt-3">
    <div class="card-body table-responsive">
        <h4 class="fw-bold card-title">Recent Transactions</h4>
      <table class="w-100 table " id="datatable">
        <thead>
          <tr>
            <th>#</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Details</th>
            {{-- <th>Name</th>
            <th>Meter</th> --}}
            <th>Date</th>
            <th>Token</th>
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
              <td>
                <p class="my-0">Code: {{$item->code}}</p>
                <p class="my-0">Name: {{$item->name}} </p>
                <p class="badge bg-info my-0"> {{$item->type}} </p>
                <p class="my-0">Meter: {{$item->meter}}</p>
              </td>
              {{-- <td>{{$item->name}}</td>
              <td>{{$item->meter}}</td> --}}
              <td>{{show_datetime($item->updated_at)}}</td>
              <td>{{$item->token}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection

@extends('user.layouts.master')
@section('title', "Package Payment")

@section('content')
<div class="card">
  <div class="card-header d-sm-flex justify-content-between">
    <h4>Make Payment to your {{strtoupper(Auth::user()->acc_type)}} Account</h4>
    <a href="{{route('user.transactions')}}" class="btn btn-primary">View Transactions</a>
  </div>
  <div class="card-body">
    @if(Auth::user()->acc_type == 'steama')
    <form action="{{route('user.payment')}}" id="steamaForm" method="post">
      @csrf
      <input type="hidden" name="meter_type" value="steama">
      <div class="form-group">
          <label class="form-label fw-bold">Meter Number</label>
          <input type="text" class="form-control" min="0" readonly name="meter" value="{{Auth::user()->meter}}" required placeholder="Meter ID">
      </div>
      <div class="row">
        <div class="form-group col-6" id="steamaNam">
          <label class="form-label fw-bold">Customer Name</label>
          <input type="text" class="form-control" name="name" value="{{$meter['customer_name']}}" readonly>
        </div>
        <input type="hidden" name="customer" value="{{$meter['customer']}}" hidden>
        <div class="form-group col-6" id="steamaNam">
          <label class="form-label fw-bold">Customer Balance</label>
          <input type="text" class="form-control" value="{{format_price($customer['account_balance'])}}" readonly>
        </div>
      </div>
      <div class="form-group">
          <label class="form-label fw-bold">Amount</label>
          <input type="number" max="{{Auth::user()->balance}}" class="form-control" min="0" name="amount" step="any" required placeholder="Amount">
      </div>
      <div class="form-group mb-0">
          <button class="btn btn-primary btn-block w-100" id="steamBtn" type="submit">Pay to Account</button>
      </div>
    </form>
    @elseif (Auth::user()->acc_type == "angaza")
    <form action="{{route('user.payment')}}" method="post" id="angazaForm">
      @csrf
      <input type="hidden" name="meter_type" value="angaza">
      <div class="form-group">
          <label class="form-label fw-bold">Meter Number</label>
          <input type="text" class="form-control" min="0" name="meter" readonly value="{{Auth::user()->meter}}" required placeholder="Meter ID">
      </div>
      <div class="row">
        <div class="form-group col-6" id="angazaName">
          <label class="form-label fw-bold">Customer Name</label>
          <input type="text" class="form-control" name="name" value="{{$customer['name']}}" readonly>
        </div>
        <input type="hidden" name="customer" value="{{$customer['qid']}}" hidden>
        <div class="form-group col-6" id="">
          <label class="form-label fw-bold">Customer Phone</label>
          <input type="text" class="form-control" name="phone" value="{{($customer['primary_phone'])}}" readonly>
        </div>
        <div class="form-group col-6" id="">
            <label class="form-label fw-bold">Total Amount</label>
            <input type="text" class="form-control" id="angazaCustomerTotal" value="{{format_price($meter['full_price'])}}" readonly>
          </div>
          <div class="form-group col-6" id="">
            <label class="form-label fw-bold">Amount Paid</label>
            <input type="text" class="form-control"  id="angazaCustomerPaid" value="{{format_price($meter['total_paid'])}}" readonly>
          </div>
          <div class="form-group col-6" id="">
            <label class="form-label fw-bold">Next Repayment</label>
            <input type="text" class="form-control"  id="angazaCustomerDue" value="{{show_datetime($meter['payment_due_date'])}}" readonly>
          </div>
          <div class="form-group col-6" id="">
            <label class="form-label fw-bold">Amount per Repayment</label>
            <input type="text" class="form-control"  id="angazaCustomerTopay" value="{{format_price($meter['payment_amount_per_period'])}}" readonly>
          </div>
      </div>
      <div class="form-group">
          <label class="form-label fw-bold">Amount</label>
          <input type="number" max="{{Auth::user()->balance}}" class="form-control" min="0" name="amount" step="any" required placeholder="Amount">
      </div>
      <div class="form-group mb-0">
          <button class="btn btn-primary btn-block w-100" type="submit">Pay to Account</button>
      </div>
    </form>
    @endif

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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
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
  #steamaName{
    display:none;
  }
  .card-header{border-top:1px solid #1d1f1d }
</style>
@endsection

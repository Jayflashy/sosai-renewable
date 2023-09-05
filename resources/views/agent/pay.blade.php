@extends('agent.layouts.master')
@section('title', "Package Payment")

@section('content')
<div class="card">
  <div class="card-header d-sm-flex justify-content-between">
    <h4>Make Payment to your {{strtoupper(Auth::user()->acc_type)}} Account</h4>
    <a href="{{route('agent.transactions')}}" class="btn btn-primary">View Transactions</a>
  </div>
  <div class="card-body">
    {{-- Select meter type --}}
    <div class="form-group">
        <label for="type" class="form-label">Meter Type</label>
        <select name="type" data-placeholder="Select Meter Type"  id="MeterSelector" class="form-select" required>
            <option value="select">Select Meter Type</option>
            <option value="angaza">Angaza Meter</option>
            <option value="steama">Seamaco Meter</option>
        </select>
    </div>

    <div id="angazaMeter">
        <h4 class="fw-bold my-2">Payment For ANGAZA Meters</h4>
        <form action="{{route('agent.payment')}}" method="post" id="angazaForm">
            @csrf
            <input type="hidden" name="meter_type" value="angaza">
            <div class="form-group">
                <label class="form-label fw-bold">Meter Number</label>
                <input type="text" id="angazaMeterID" class="form-control" min="0" name="meter" required placeholder="Angaza Meter ID">
            </div>
            <div class="row">
              <div class="form-group col-6" id="angazaName">
                <label class="form-label fw-bold">Customer Name</label>
                <input type="text" class="form-control" name="name" id="angazaCustomerName" readonly>
              </div>
              <input type="hidden" name="customer" id="angazaCustomer" hidden>
              <div class="form-group col-6" id="">
                <label class="form-label fw-bold">Customer Phone</label>
                <input type="text" class="form-control" name="phone" id="angazaCustomerPhone" readonly>
              </div>
              <div class="form-group col-6" id="">
                <label class="form-label fw-bold">Total Amount</label>
                <input type="text" class="form-control" id="angazaCustomerTotal" readonly>
              </div>
              <div class="form-group col-6" id="">
                <label class="form-label fw-bold">Amount Paid</label>
                <input type="text" class="form-control"  id="angazaCustomerPaid" readonly>
              </div>
              <div class="form-group col-6" id="">
                <label class="form-label fw-bold">Next Repayment</label>
                <input type="text" class="form-control"  id="angazaCustomerDue" readonly>
              </div>
              <div class="form-group col-6" id="">
                <label class="form-label fw-bold">Amount per Repayment</label>
                <input type="text" class="form-control"  id="angazaCustomerTopay" readonly>
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
    </div>
    <div id="steamaMeter">
        <h4 class="fw-bold my-2">Paying For Steamaco Meters</h4>
        <form action="{{route('agent.payment')}}" id="steamaForm" method="post">
            @csrf
            <input type="hidden" name="meter_type" value="steama">
            <div class="form-group">
                <label class="form-label fw-bold">Meter Number</label>
                <input type="text" intype="number" class="form-control" min="0" name="meter" id="steamaMeterID" required placeholder="Meter ID">
            </div>
            <div class="row">
              <div class="form-group col-6" id="steamaNam">
                <label class="form-label fw-bold">Customer Name</label>
                <input type="text" class="form-control" name="name" value="" readonly id="steamaCustomerName">
              </div>
              <input type="hidden" name="customer" value="" hidden id="steamaCustomer">
              <div class="form-group col-6" id="steamaNam">
                <label class="form-label fw-bold">Customer Balance</label>
                <input type="text" class="form-control" value="" readonly id="steamaCustomerBal">
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
    #steamaMeter{
      display:none;
    }
    #angazaMeter{
        display:none;
    }
    #steamaName{
        display:none;
    }
  .card-header{border-top:1px solid #1d1f1d }
</style>
@endsection
@section('scripts')
<script>
    $("#MeterSelector").change(function() {
    var verify_name = $('#MeterSelector').find(":selected").val();
    if(verify_name == 'angaza'){
      $("#steamaMeter").css("display", "none");
      $("#angazaMeter").css("display", "block");
    }else if(verify_name == 'steama'){
      $("#angazaMeter").css("display", "none");
      $("#steamaMeter").css("display", "block");
    }else{
      $("#angazaMeter").css("display", "none");
      $("#steamaMeter").css("display", "none");
    }
  });
  $("input[intype='number']").on('input', function(e) {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
  });
</script>
<script>
    $("#steamaMeterID").keyup(function(){
        var meter = $(this).val();
        if(meter.length >= 6) {
            // get customer details from api
            $.ajax({
            type:'GET',
            url:"{{route('agent.verify.steama')}}",
            dataType: 'json',
            data:{meter},
            beforeSend: function(){
                $("#steamaCustomerName").val("Loading Customer Name");
                $("#steamaCustomerBal").val("Loading Details");
            },
            success: function(result){
                console.log(result)
                if(result.status == 'success'){
                    $("#steamaCustomerName").val(result.name);
                    $("#steamaCustomerBal").val(result.balance);
                    $("#steamaCustomer").val(result.customer);
                } else{
                    $("#steamaCustomerName").val("Unable to veriy Meter");
                    $("#steamaCustomerBal").val("Loading Details");
                }
            },
        });
        }
    });
    $("#angazaMeterID").keyup(function(){
        var meter = $(this).val();
        if(meter.length >= 6) {
            // get customer details from api
            $.ajax({
            type:'GET',
            url:"{{route('agent.verify.angaza')}}",
            dataType: 'json',
            data:{meter},
            beforeSend: function(){
                $("#angazaCustomerName").val("Loading Customer Name");
                $("#angazaCustomerPhone").val("Loading Details");
            },
            success: function(result){
                console.log(result)
                if(result.status == 'success'){
                    $("#angazaCustomerName").val(result.name);
                    $("#angazaCustomerPhone").val(result.phone);
                    $("#angazaCustomer").val(result.customer);
                    $("#angazaCustomerTotal").val(result.total);
                    $("#angazaCustomerPaid").val(result.paid);
                    $("#angazaCustomerTopay").val(result.to_pay);
                    $("#angazaCustomerDue").val(result.due_date);
                } else{
                    $("#steamaCustomerName").val("Unable to veriy Meter");
                    $("#steamaCustomerBal").val("Loading Details");
                }
            },
        });
        }
    });
</script>
@endsection

@extends('agent.layouts.master')
@section('title', "Meter Payments")

@section('content')
<div class="card">
  <div class="card-header d-sm-flex justify-content-between">
    <h4>Make Meter Payments</h4>
    <a href="{{route('agent.transactions')}}" class="btn btn-success ">View Transactions</a>
  </div>
  <div class="card-body">
    {{-- Select meter type --}}
    <div class="form-group">
        <label for="type" class="form-label">Meter Type</label>
        <select name="type" data-placeholder="Select Meter Type"  id="MeterSelector" class="form-select" required>
            <option value="select">Select Meter Type</option>
            <option value="angaza">Angaza Meter</option>
            <option value="steama">Steamaco Meter</option>
            {{-- <option value="paygee">Paygee Account</option> --}}
        </select>
    </div>

    <div id="angazaMeter">
        <h4 class="fw-bold my-2">Payment For ANGAZA Meters</h4>
        <form action="{{route('app.agent.payment')}}" method="post" id="angazaForm">
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
            <div class="col-4">
                <button type="button" id="validateAngaza" class="btn btn-primary btn-sm w-100 mb-2"><span>Validate Meter</span></button>
            </div>
            <div class="form-group mb-0">
                <button id="angazaSubmit" class="btn btn-success btn-block w-100" type="submit">Pay to Account</button>
            </div>
        </form>
    </div>
    <div id="steamaMeter">
        <h4 class="fw-bold my-2">Paying For Steamaco Meters</h4>
        <form action="{{route('app.agent.payment')}}" id="steamaForm" method="post">
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
                <input type="number" class="form-control" min="0" name="amount" step="any" required placeholder="Amount">
            </div>
            <div class="form-group col-4">
                <button type="button" id="validateSteama" class="btn btn-primary w-100 mb-2 btn-sm"><span>Validate Meter</span></button>
            </div>
            <div class="form-group mb-0">
                <button class="btn btn-success btn-block w-100" id="steamBtn" type="submit">Pay to Account</button>
            </div>
        </form>
    </div>
    <div id="paygeeMeter">

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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Agent</a></li>
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
    #paygeeMeter{
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
      $("#paygeeMeter").css("display", "none");
    }else if(verify_name == 'steama'){
      $("#angazaMeter").css("display", "none");
      $("#steamaMeter").css("display", "block");
      $("#paygeeMeter").css("display", "none");
    }else if(verify_name == 'paygee'){
      $("#angazaMeter").css("display", "none");
      $("#steamaMeter").css("display", "none");
      $("#paygeeMeter").css("display", "block");
    }else{
      $("#angazaMeter").css("display", "none");
      $("#steamaMeter").css("display", "none");
      $("#paygeeMeter").css("display", "none");
    }
  });
  $("input[intype='number']").on('input', function(e) {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
  });
</script>
<script>
    $("#validateSteama").click(function(){
        var meter = $("#steamaMeterID").val();
        if(meter.length >= 6) {
            // get customer details from api
            $.ajax({
            type:'GET',
            url:"{{route('app.agent.verify.steama')}}",
            dataType: 'json',
            data:{meter},
            beforeSend: function(){
                // show loader
                $.LoadingOverlay("show",{
                    image: "{{my_asset(get_setting('favicon'))}}"
                });
            },
            success: function(result){
                console.log(result)
                $.LoadingOverlay("hide");
                if(result.status == 'success'){
                    // remove validate button
                    $("#steamaCustomerName").val(result.name);
                    $("#steamaCustomerBal").val(result.balance);
                    $("#steamaCustomer").val(result.customer);

                    $("#steamBtn").css('display','block');
                } else{
                    Snackbar.show({
                        backgroundColor: '#e3342f',
                        pos: 'top-right',
                        text: result.message,
                    });
                }
            },
        });
        }
        else{
            Snackbar.show({
                backgroundColor: '#e3342f',
                pos: 'top-right',
                text: 'Please checkt meter number',
            });
        }
    });
    $("#validateAngaza").click(function(){
        var meter = $("#angazaMeterID").val();
        if(meter.length >= 6) {
            // get customer details from api
            $.ajax({
            type:'GET',
            url:"{{route('app.agent.verify.angaza')}}",
            dataType: 'json',
            data:{meter},
            beforeSend: function(){
                $.LoadingOverlay("show",{
                    image: "{{my_asset(get_setting('favicon'))}}"
                });

            },
            success: function(result){
                $.LoadingOverlay("hide");
                console.log(result)
                if(result.status == 'success'){
                    // remove validate button
                    $("#angazaCustomerName").val(result.name);
                    $("#angazaCustomerPhone").val(result.phone);
                    $("#angazaCustomer").val(result.customer);
                    $("#angazaCustomerTotal").val(result.total);
                    $("#angazaCustomerPaid").val(result.paid);
                    $("#angazaCustomerTopay").val(result.to_pay);
                    $("#angazaCustomerDue").val(result.due_date);

                    $("#angazaSubmit").css('display','block');
                } else{
                    Snackbar.show({
                        backgroundColor: '#e3342f',
                        pos: 'top-right',
                        text: result.message,
                    });
                    swal("Error!", result.message, "warning");
                }
            },
        });
        }
        else{
            Snackbar.show({
                backgroundColor: '#e3342f',
                pos: 'top-right',
                text: 'Please input meter number',
            });
        }
    });
</script>
@endsection

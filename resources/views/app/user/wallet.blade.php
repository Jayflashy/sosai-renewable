@extends('user.layouts.master')
@section('title', "Fund Wallet")

@section('content')
<div class="card">
    <div class="card-body">
        <form action="" method="post">
            @csrf
            <div class="form-group">
                <label class="form-label fw-bold">Email</label>
                <input type="email" class="form-control" name="email" required placeholder="Email Address" value="{{Auth::user()->email}}">
            </div>
            <div class="form-group">
                <label class="form-label fw-bold">Amount</label>
                <input type="number" class="form-control" min="0" name="amount" step="any" required placeholder="Amount">
            </div>
            <div class="form-group mb-0">
                <button class="btn btn-primary btn-block w-100" type="submit">Fund Wallet</button>
            </div>
        </form>
    </div>
</div>

{{-- <div class="card" id="auto-bank">
    <div class="card-body">
        <h4 class="fw-bold mb-0">Bank Accounts</h4>
        <p>Make transfer to any of these accounts to fund your wallet instantly (charges applied).</p>
        <div class="row">
            <div class="col-md-6">
                <div class="acc-panel">
                    <h6>Bank Name: Sterling Bank</h6>
                    <h6>Acc Name: Jay flashy</h6>
                    <p class="acc-num">Acc Number: <span onclick="copyDivContent('1234323431')">33215678765 <i class="ms-2 far fa-copy"></i></span> </p>
                </div>
            </div>  
        </div>
    </div>
</div> --}}
<script>
    function copyDivContent(element)
    {
        var aux = document.createElement("input");
        // Assign it the value of the specified element
        aux.setAttribute("value", element);
        document.body.appendChild(aux);
        aux.select();
        document.execCommand("copy");
        document.body.removeChild(aux);
        alert('Copied');
    }
</script>
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
    .acc-panel{
    flex-direction: column;
    min-width: 0;
    border-color: #ebedf2;
    background-clip: border-box;
    margin-bottom: 10px;
    -webkit-box-shadow: 0px 2px 5px 0px rgba(101, 89, 114, 0.3);
    box-shadow: 0px 2px 5px 0px rgba(90, 82, 99, 0.3);
    /* text-align: center!important; */
    padding: .7rem;
    border: 1px solid #84f508!important;
    border-radius: 0.325rem !important;
    }
    .acc-num{
    color:#121416;
    margin-bottom: 0;
    }
    [data-theme = dark] .acc-num{
    color:#cfe2ff;
    }
    .acc-num >span >i{
    cursor: pointer;
    }
</style>    
@endsection
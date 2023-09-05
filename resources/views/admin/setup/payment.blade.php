@extends('admin.layouts.master')

@section('title', "Payment Setting")

@section('page-header')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Payment Settings</h3>
            <div class="nk-block-des text-soft">
                <p>Configure payment gateways.</p>
            </div>
        </div><!-- .nk-block-head-content -->
        
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
@endsection
@section('content')
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 fw-bold ">Paystack Payment</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-9">
                        <label class="form-label">Enable Paystack</label>
                    </div>
                    <div class="col-md-3">
                        <label class="jdv-switch jdv-switch-success mb-0">
                            <input type="checkbox" onchange="updateSystem(this, 'paystack_payment')" @if(sys_setting('paystack_payment') == 1) checked @endif>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 fw-bold ">Paystack Credentials</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.settings.env_key') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="paystack">
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYSTACK_PUBLIC_KEY">
                        <label class="form-label">{{__('PUBLIC KEY')}}</label>
                        <input type="text" class="form-control" name="PAYSTACK_PUBLIC_KEY" value="{{  env('PAYSTACK_PUBLIC_KEY') }}" placeholder="PUBLIC KEY" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYSTACK_SECRET_KEY">
                        <label class="form-label">{{__('SECRET KEY')}}</label>
                        <input type="text" class="form-control" name="PAYSTACK_SECRET_KEY" value="{{  env('PAYSTACK_SECRET_KEY') }}" placeholder="SECRET KEY" required>
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn w-100 btn-primary">{{__('Save')}}</button>
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

@section('scripts')
<script>        
    function updateSystem(el, name){
        if($(el).is(':checked')){
            var value = 1;
        }
        else{
            var value = 0;
        }
        $.post('{{ route('admin.settings.sys_settings') }}', {_token:'{{ csrf_token() }}', name:name, value:value}, function(data){
            if(data == '1'){
                Snackbar.show({
                    text: '{{__('Settings Updated Successfully')}}',
                    pos: 'top-right',
                    backgroundColor: '#38c172'
                });
            }
            else{
                Snackbar.show({
                    text: '{{__('Something went wrong')}}',
                    pos: 'top-right',
                    backgroundColor: '#e3342f'
                });
            }
        });
    }
</script>
@endsection
@section('styles')
<style>
    .card{margin-bottom: 20px}
</style>
@endsection
@extends('admin.layouts.master')

@section('title', "Website Setting")

@section('page-header')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Website Settings</h3>
            <div class="nk-block-des text-soft">
                <p>Configure website settings.</p>
            </div>
        </div><!-- .nk-block-head-content -->

    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
@endsection
@section('content')
<div class="card">
    <div class="card-header h4">Website Information </div>
    <div class="card-body">
        <form action="{{route('admin.settings.update')}}" method="post" class="row form-validate">
            @csrf
            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-sm-3 form-label">@lang('Website Name')</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" required class="form-control" value="{{ get_setting('title') }}">
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label class="col-sm-3 form-label">@lang('Short Name')</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" required class="form-control" value="{{ get_setting('name') }}">
                    </div>
                </div> --}}
                <div class="form-group row">
                    <label class="col-sm-3 form-label">@lang('Website Email')</label>
                    <div class="col-sm-9">
                        <input type="text" name="email" class="form-control" value="{{ get_setting('email') }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-sm-3 form-label">@lang('Website Phone')</label>
                    <div class="col-sm-9">
                        <input type="tel" name="phone" required class="form-control" value="{{ get_setting('phone') }}">
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label class="col-sm-3 form-label">@lang('Address')</label>
                    <div class="col-sm-9">
                        <input type="text" name="address" required class="form-control" value="{{ get_setting('address') }}">
                    </div>
                </div> --}}
                <div class="form-group row">
                    <label class="col-sm-3 form-label">@lang('Website About')</label>
                    <div class="col-sm-9">
                        <textarea name="description" rows="2" class="form-control">{{ get_setting('description') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="form-group mt-2 ">
                <button class="btn-success btn w-100" type="submit">Save Settings</button>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header h4">Social Links </div>
    <div class="card-body">
        <form action="{{route('admin.settings.update')}}" method="post" class="row">
            @csrf
            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-sm-3 form-label">@lang('Facebook')</label>
                    <div class="col-sm-9">
                        <input name="facebook" type="text" class="form-control" value="{{get_setting('facebook') }}" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 form-label">@lang('Twitter')</label>
                    <div class="col-sm-9">
                        <input name="twitter" type="text" class="form-control" value="{{get_setting('twitter') }}" >
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label class="col-sm-3 form-label">@lang('Telegram')</label>
                    <div class="col-sm-9">
                        <input name="telegram" type="text" class="form-control" value="{{get_setting('telegram') }}" >
                    </div>
                </div> --}}
            </div>
            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-sm-3 form-label">@lang('Instagram')</label>
                    <div class="col-sm-9">
                        <input name="instagram" type="text" class="form-control" value="{{get_setting('instagram') }}" >
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label class="col-sm-3 form-label">@lang('Whatsapp')</label>
                    <div class="col-sm-9">
                        <input name="whatsapp" type="text" class="form-control" value="{{get_setting('whatsapp') }}" >
                    </div>
                </div> --}}
            </div>
            <div class="mt-2 text-end">
                <button class="btn-success btn w-100" type="submit">Save Settings</button>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header h4">Logo/Image Settings</div>
    <div class="card-body">
        <form class="row" action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-lg-6">
                <label class="form-label">@lang('Site Logo')</label>
                <div class="col-sm-12 row">
                    <input type="file" class="form-control" name="logo" accept="image/*"/>
                    <img class="primage mt-2" src="{{ my_asset(get_setting('logo'))}}" alt="Site Logo" >
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label class="form-label">@lang('Favicon')</label>
                <div class="col-sm-12">
                    <input type="file" class="form-control" name="favicon" accept="image/*"/>
                    <img class="primage mt-2" src="{{ my_asset(get_setting('favicon'))}}" alt="Favicon" >
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-success w-100" type="submit">@lang('Update Setting')</button>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header h4">Currency Settings</div>
    <div class="card-body">
        <form class="row" action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-sm-6 ">
                <label class="form-label">Currency Symbol</label>
                <input type="text" class="form-control" name="currency" value="{{get_setting('currency')}}" required placeholder="Currency Symbol"/>
            </div>
            <div class="form-group col-sm-6">
                <label class="form-label">Currency Code</label>
                <input type="text" class="form-control" name="currency_code" value="{{get_setting('currency_code')}}" required placeholder="Currency Code"/>
            </div>
            <div class="text-end">
                <button class="btn btn-success w-100" type="submit">@lang('Update Setting')</button>
            </div>
        </form>
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
    .primage {
        max-height: 50px !important;
        max-width: 150px !important;
        margin: 0;
    }
    .card-header{border-top:1px solid #1d1f1d }
    .card{margin-bottom: 20px}
</style>
@endsection

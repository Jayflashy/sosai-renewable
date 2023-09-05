@extends('admin.layouts.master')

@section('title', "API SEttings")

@section('page-header')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Website Ads</h3>
            <div class="nk-block-des text-soft">
                <p>Manage system Ads.</p>
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
                <h5 class="mb-0 fw-bold ">Steamaco Credentials</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.settings.env_key') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="STEAMACO_USERNAME">
                        <label class="form-label">{{__('STEAMACO USERNAME')}}</label>
                        <input type="text" class="form-control" name="STEAMACO_USERNAME" value="{{  env('STEAMACO_USERNAME') }}" placeholder="STEAMA USERNAME" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="STEAMACO_PASSWORD">
                        <label class="form-label">{{__('STEAMA PASSWORD')}}</label>
                        <input type="password" class="form-control" name="STEAMACO_PASSWORD" value="{{  env('STEAMACO_PASSWORD') }}" placeholder="PASSWORD" required>
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn w-100 btn-primary">{{__('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 fw-bold ">Angaza Credentials</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.settings.env_key') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="ANGAZA_USERNAME">
                        <label class="form-label">{{__('ANGAZA USERNAME')}}</label>
                        <input type="text" class="form-control" name="ANGAZA_USERNAME" value="{{  env('ANGAZA_USERNAME') }}" placeholder="Angaza Username" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="ANGAZA_PASSWORD">
                        <label class="form-label">{{__('ANGAZA PASSWORD')}}</label>
                        <input type="password" class="form-control" name="ANGAZA_PASSWORD" value="{{  env('ANGAZA_PASSWORD') }}" placeholder="Angaza Password" required>
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

@section('scripts')

@endsection
@section('styles')
<style>
    .card-header{border-top:1px solid #1d1f1d }
    .card{margin-bottom: 20px}
</style>
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
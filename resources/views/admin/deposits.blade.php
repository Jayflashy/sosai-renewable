@extends('admin.layouts.master')

@section('title', "Deposits History")

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
<div class="card mt-3">
    {{-- <h4 class="fw-bold card-header">Wallet Deposit History</h4> --}}
    <div class="card-body table-responsive">
      <table class="w-100 table" id="datatable">
        <thead>
          <tr>
            <th>#</th>
            <th>Username</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Trx Code</th>
            <th>Date</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($deposits as $key=> $item)
            <tr>
              <td>{{$key +1 }}</td>
              <td>{{format_price($item->amount) }}</td>
              <td>{{$item->user->username}}</td>
              <td>
                @if($item->status == 1)
                    <span class="badge bg-success">successful</span>
                @elseif ($item->status == 2)
                    <span class="badge bg-warning">pending</span>
                @elseif ($item->status == 3)
                    <span class="badge bg-danger">failed</span>
                @endif        
              </td>
              <td>{{$item->trx}}</td>
              <td>{{show_datetime($item->updated_at)}}</td>
              <td>{{$item->message}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
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
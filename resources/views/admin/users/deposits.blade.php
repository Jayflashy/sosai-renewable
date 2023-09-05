@extends('admin.layouts.master')
@section('title', 'User Deposits')

@section('content')
<div class="card">
    <div class="card-body table-responsive">
     <table class="table table-bordered" id="datatable">
         <thead>
             <tr>         
                 <th>#</th>
                 <th>TRX ID</th>
                 <th>Amount</th>
                 <th>Method</th>
                 <th>Details</th>
                 <th>Status</th>
                 <th>Date</th>
             </tr>
         </thead>
         <tbody>
         @foreach ($deposits as $key => $item)
             <tr>
                 <td>{{$key+1}}</td>
                 <td>{{$item->trx}}</td>
                 <td>{{format_price($item->amount)}}</td>
                 <td><span class="badge bg-info">{{$item->gateway}}</span></td>
                 <td>{{$item->message}}</td>
                 <td>
                     @if($item->status == 1)
                         <span class="badge bg-success">@lang('successful')</span>
                     @elseif ($item->status == 2)
                         <span class="badge bg-warning">@lang('Pending')</span>
                     @elseif ($item->status == 3)
                         <span class="badge bg-danger">@lang('failed')</span>
                     @endif    
                 </td>                    
                 <td>{{show_datetime($item->created_at)}}</td>
             </tr>
         @endforeach
         </tbody>
     </table>
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
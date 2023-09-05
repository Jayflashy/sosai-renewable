@extends('admin.layouts.master')
@section('title', 'Angaza Accounts')
@section('content')
<div class="card">
    <div class="card-header">
        <h5>Angaza Accounts</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover" id="datatable">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Account Number</th>
                    {{-- <th>Client Name</th> --}}
                    <th>Full Price</th>
                    <th>Total Paid</th>
                    <th>Registration</th>
                    <th>Last Payment</th>
                    <th>Next Payment</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($meters['item'] as $key => $item)
                <tr>
                    <th>{{$key + 1}}</th>
                    <td>{{ $item['number'] }}</td>
                    {{-- <td>{{ $item['qid'] ??"null" }}</td> --}}
                    <td>{{ format_price($item['full_price'])}}</td>
                    <td>{{ format_price($item['total_paid'])}}</td>
                    <td> {{show_datetime($item['registration_date']) }} </td>
                    <td> {{show_datetime($item['latest_payment_when']) }} </td>
                    <td> {{show_datetime($item['payment_due_date']) }} </td>
                    <td><span class="badge @if($item['status'] == "ENABLED")bg-success @else bg-warning @endif">{{$item['status']}}</span></td>
                </tr>
                @endforeach
            </tbody>            
        </table>
    </div>
</div>
@endsection
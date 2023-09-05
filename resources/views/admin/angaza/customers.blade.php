@extends('admin.layouts.master')
@section('title', 'Angaza Clients')
@section('content')
<div class="card">
    <h4 class="card-header">Angaza Clients</h4>
    <div class="card-body table-responsive">
        <table class="table table-bordered" id="datatable">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Client ID</th>
                    <th>Name</th>
                    <th>Telephone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers['item'] as $key => $item)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{ $item['qid'] }}</td>
                    <td>{{ $item['name'] ??"" }} </td>
                    <td>{{ $item['primary_phone'] ?? "null"}}</td>
                    <td> {{ $item['attribute_values'][6]['value'] }} </td>
                </tr>
                @endforeach
            </tbody>            
        </table>
    </div>
</div>
@endsection
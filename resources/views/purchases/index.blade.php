@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0 ml-0 mr-0">
    <div class="headline-contents headline-contents-height">
        <h2 class="d-inline-block headline-content">Purchases</h2>
        <div class="float-md-right">
            <div class="btn-toolbar d-inline-block" role="toolbar">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    @if(request('start_date'))
                    <a href="/purchasesexcel?start_date={{request('start_date')}}&end_date={{request('end_date')}}" class="btn btn-light"><i class="fa fa-file-excel"></i> Excel</a>
                    @else
                    <a href="/purchasesexcel" class="btn btn-light"><i class="fa fa-file-excel"></i> Excel</a>
                    @endif
                    <a href="/purchasespdf" class="btn btn-light"><i class="fa fa-file-pdf"></i> PDF</a>
                    <a href="/purchasescsv" class="btn btn-light"><i class="fas fa-file-csv"></i> CSV</a>
                </div>
            </div>
            <a href="/purchases/add" class="btn btn-primary">Add Purchase</a>
        </div>
    </div>
    @include('components.filters.datefilter')
    <div class="">
        <table class="table dataTable">
            <thead>
                <tr class="product-list-menu">
                    <th>Purchase No.</th>
                    <th>Order ID</th>
                    <th>Vendor Name</th>
                    <th>Date</th>
                    <th>Due Date</th>
                    <th class="text-right">Amount</th>
                    <th>Status</th>
                    <th width="160px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $key => $purchase)
                <tr>
                    <td>P/O-00{{$purchase->sr_no}}</td>
                    <td>{{$purchase->order_id}}</td>
                    <td>{{$purchase->vendor->name}}</td>
                    <td>{{$purchase->purchase_date}}</td>
                    <td>{{$purchase->due_date}}</td>
                    <td class="text-right">&#8377; {{$purchase->grand_total}}</td>
                    <td><span class="badge badge-{{$purchase->remaining_amount ? 'warning' : 'success'}}">{{$purchase->remaining_amount ? 'Pending' : 'Completed'}}</span> </td>
                    <td>
                        @if(!$purchase->remaining_amount)
                        <a href="#" class="btn btn-sm disabled"><i class="fa fa-pencil"></i></a>
                        @else
                        <a href="/purchases/{{$purchase->id}}/edit" class="btn btn-sm"><i class="fa fa-pencil"></i></a>
                        @endif
                        <a href="/purchases/{{$purchase->sr_no}}" class="btn btn-sm"><i class="fa fa-eye"></i></a>
                        <form method="post" action="/purchases/{{$purchase->id}}/delete" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure, You want to delete this purchase?');"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

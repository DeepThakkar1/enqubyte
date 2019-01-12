@extends('layouts.app')

@section('content')
<div class="container-fluid pl-md-0 pr-md-0 ml-md-0 mr-md-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content">Purchases</h2>
        <a href="/purchases/add" class="btn btn-primary float-right">Add Purchase</a>
    </div>
    @include('components.filters.datefilter')
    <div class="mt-4">
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
                    <th width="160px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $key => $purchase)
                <tr>
                    <td>{{$purchase->sr_no}}</td>
                    <td>{{$purchase->order_id}}</td>
                    <td>{{$purchase->vendor->name}}</td>
                    <td>{{$purchase->purchase_date}}</td>
                    <td>{{$purchase->due_date}}</td>
                    <td class="text-right">{{$purchase->grand_total}}</td>
                    <td><span class="badge badge-{{$purchase->remaining_amount ? 'warning' : 'success'}}">{{$purchase->remaining_amount ? 'Pending' : 'Completed'}}</span> </td>
                    <td>
                        <a href="/purchases/{{$purchase->id}}/edit" class="btn btn-sm"><i class="fa fa-pencil"></i></a>
                        <a href="/purchases/{{$purchase->id}}" class="btn btn-sm"><i class="fa fa-eye"></i></a>

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

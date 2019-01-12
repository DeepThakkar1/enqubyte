@extends('layouts.app')

@section('content')
<div class="container-fluid pl-md-0 pr-md-0 ml-md-0 mr-md-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content"><span>
            <a href="/vendors" class="btn btn-sm text-primary"><i class="fa fa-arrow-left"></i></a>
            <a href="/home"> Home  </a>
            <a href="/vendors"><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Vendors</a>
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> {{$vendor->fullname}}
        </h2>
    </div>
    <div class="container px-5">
        <div class="d-flex align-self-center">
            <div class="py-2">
                <div>Vendor</div>
                <h3><a href="" class="text-primary"> {{$vendor->name}}</a></h3>
            </div>
            <div class="ml-auto p-2">
                <div class="d-flex">
                    <div class="px-4 text-center">
                        <div>Total Purchases</div>
                        <h3>{{ count($vendor->purchases)}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container px-5 mt-3">
        <div class="card">
            <div class="card-header">
                <strong>Orders</strong>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">PO No.</th>
                                <th>Order No.</th>
                                <th>Date</th>
                                <th>Due Date</th>
                                <th class="right">Total Amount</th>
                                <th class="right">Remaining Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vendor->purchases as $key => $purchase)
                            <tr>
                                <td><a href="/purchases/{{$purchase->sr_no}}" target="_blank" class="text-primary">P/O 00{{$purchase->sr_no}}</a></td>
                                <td>{{$purchase->order_id}}</td>
                                <td>{{$purchase->purchase_date}}</td>
                                <td>{{$purchase->due_date}}</td>
                                <td>{{$purchase->grand_total}}</td>
                                <td>{{$purchase->remaining_amount}}</td>
                                <td><span class="badge badge-{{$purchase->remaining_amount ? 'warning' : 'success'}}"> {{$purchase->remaining_amount ? 'Pending' : 'Completed'}}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
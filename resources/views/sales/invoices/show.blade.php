@extends('layouts.app')

@section('content')
<div class="container-fluid pl-md-0 pr-md-0 ml-md-0 mr-md-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content"><a href="/sales/invoices" class="btn btn-sm text-primary"><i class="fa fa-arrow-left"></i></a> Invoice</h2>
        <!-- <a href="/sales/invoices/add" class="btn btn-primary float-right">Add Invoice</a> -->
    </div>
    <div class="container">
    <div class="d-flex px-3 align-self-center">
        <div class="py-2">
            <div>Status</div>
            <div class="bg-primary text-white px-2 rounded">Unset</div>
        </div>
        <div class="px-4 py-2">
            <div>Customer</div>
            <h3><a href="" class="text-primary"> {{$invoice->customer->fullname}}</a></h3>
        </div>
        <div class="ml-auto p-2">
            <div class="d-flex">
                <div class="px-4">
                    <div>Amount Due</div>
                    <h3>&#8377; {{$invoice->grand_total}}</h3>
                </div>
                <div>
                    <div>Due</div>
                    <h3>{{$invoice->due_date}}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex p-3">
                <div class="px-4">
                    <h3 class="">Create invoice</h3>
                    <div class=""><b>Created:</b> {{$invoice->created_at->diffForHumans()}}</div>
                </div>
                <div class="ml-auto p-2">
                    <a href="/sales/invoices/{{$invoice->id}}/edit" class="btn btn-outline-primary">Edit Invoice</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex p-3">
                <div class="px-4">
                    <h3 class="">Send invoice</h3>
                    <div class=""><b>Skipped:</b> You never sent this invoice.</div>
                </div>
                <div class="ml-auto p-2">
                    <a href="#" class="btn btn-outline-primary">Send Invoice</a>
                    <a href="#" class="btn btn-outline-primary">Mark as Sent</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex p-3">
                <div class="px-4">
                    <h3 class="">Get Paid</h3>
                </div>
                <div class="ml-auto p-2">
                    <a href="#" class="btn btn-outline-primary">Record a Payment</a>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                Invoice
                <strong>{{$invoice->id}}</strong>
                <span class="float-right"> <strong>Status:</strong> Pending</span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">From:</h6>
                        <div>
                            <strong>{{auth()->user()->company_name}}</strong>
                        </div>
                        <div>Email: {{auth()->user()->email}}</div>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="mb-3">To:</h6>
                        <div>
                            <strong>{{$invoice->customer->fullname}}</strong>
                        </div>
                        <div>{{$invoice->customer->address}}</div>
                        <div>{{$invoice->customer->phone}}</div>
                        <div>{{$invoice->customer->email}}</div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th>Description</th>
                                <th class="right">Price</th>
                                <th class="center">Qty</th>
                                <th class="center">Tax</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice->invoiceitems as $key => $item)
                            <tr>
                                <td class="center">{{$key + 1}}</td>
                                <td class="left strong">{{$item->product->name}}</td>
                                <td class="left">{{$item->product->description}}</td>
                                <td class="right">{{$item->price}}</td>
                                <td class="center">{{$item->qty}}</td>
                                <td class="center">{{$item->tax}} %</td>
                                <td class="right">{{$item->product_tot_amt}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">&#8377; {{$invoice->sub_tot_amt}}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Discount</strong>
                                    </td>
                                    <td class="right">{{$invoice->discount}} {{isset($invoice->discount_type) && $invoice->discount_type ==1 ? '%' : ''}}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong>&#8377; {{$invoice->grand_total}}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
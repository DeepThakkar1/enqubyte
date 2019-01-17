@extends('layouts.app')

@section('content')
<div class="container-fluid pl-md-0 pr-md-0 ml-md-0 mr-md-0">
    <div class="headline-contents headline-border-bottom">
        <h2 class="d-inline-block headline-content pb-2 pt-1">
            <a href="/sales/invoices" class="mr-1"><i class="fa fa-arrow-left"></i></a>
            Invoice
        </h2>
        <!-- <a href="/sales/invoices/add" class="btn btn-primary float-right">Add Invoice</a> -->
    </div>
    <div class="container px-5">
    <div class="d-flex align-self-center">
        <div class="py-2">
            <div>Status</div>
            <div class="bg-{{$invoice->remaining_amount ? 'warning' : 'success'}} text-white px-2 rounded mt-2"><span class="invoiceStatus"> {{$invoice->remaining_amount ? 'Pending' : 'Completed'}} </span></div>
        </div>
        <div class="px-4 py-2">
            <div>Customer</div>
            <h3><a href="" class="text-primary custom-primary-text"> {{$invoice->visitor->fullname}}</a></h3>
        </div>
        <div class="ml-auto p-2">
            <div class="d-flex">
                @if(isset($invoice->enquiry))
                <div class="px-4">
                    <div>Enquiry</div>
                    <h3>
                    <a href="/enquiries/{{$invoice->enquiry->id}}"  class="text-primary">ENQ-00{{$invoice->enquiry->sr_no}} </a>
                    </h3>
                </div>
                @endif
                <div class="pr-4">
                    <div>Amount Due</div>
                    <h3 class="mt-2 Due">&#8377; <span class="invoiceAmt">{{$invoice->remaining_amount}}</span></h3>
                </div>
                <div>
                    <div>Due</div>
                    <h3 class="mt-2 Due">{{$invoice->due_date}}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex p-3">
                <div class="px-4">
                    <h3 class="">INV-00{{$invoice->sr_no}}</h3>
                    <div class=""><b>Created:</b> {{$invoice->created_at->diffForHumans()}}</div>
                </div>
                <div class="ml-auto p-2">
                    @if(count($invoice->payments))
                    <a href="javascript:;" class="btn btn-outline-primary disabled">Edit Invoice</a>
                    @else
                    <a href="/sales/invoices/{{$invoice->id}}/edit" class="btn btn-outline-primary btnEditInvoice">Edit Invoice</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="card mt-3">
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
    </div> -->

    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex p-3">
                <div class="px-4">
                    <h3 class="pt-2">Get Paid</h3>
                </div>
                <div class="ml-auto p-2">
                    @if($invoice->remaining_amount)
                    <a href="#recordPaymentModal" data-toggle="modal" class="btn btn-outline-primary btnRecordPayment">Record a Payment</a>
                    @else
                    <a href="#" class="btn btn-outline-primary disabled">Record a Payment</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container px-5 mt-3">
        <div class="card">
            <div class="card-header">
                <strong>INV-00{{$invoice->sr_no}}</strong>
                <span class="float-right"> <strong>Status:</strong> <span class="invoiceStatus"> {{$invoice->remaining_amount ? 'Pending' : 'Completed'}} </span></span>
            </div>
            <div class="card-body p-0">
                <div class="row p-3">
                    <!-- <div class="col-sm-6">
                        <h6 class="mb-3">From:</h6>
                        <div>
                            <strong>{{auth()->user()->company_name}}</strong>
                        </div>
                        <div>Email: {{auth()->user()->email}}</div>
                    </div> -->
                    <div class="col-sm-8">
                        <h6 class="mb-3">Bill To:</h6>
                        <div>
                            <strong>{{$invoice->visitor->fullname}}</strong>
                        </div>
                        <div>{{$invoice->visitor->address}}</div>
                        <div>{{$invoice->visitor->phone}}</div>
                        <div>{{$invoice->visitor->email}}</div>
                    </div>
                    <div class="col-sm-4">
                        <!-- <h6 class="mb-3">Bill To:</h6> -->
                        <div>
                            <strong>Invoice Number : </strong> INV-00{{$invoice->sr_no}}
                        </div>
                        <div><strong>Invoice Date : </strong> {{$invoice->invoice_date}}</div>
                        <div><strong>Payment Due : </strong> {{$invoice->due_date}}</div>
                        <div><strong>Amount Due (INR) : </strong> &#8377; <span class="invoiceAmt">{{$invoice->remaining_amount}} </span></div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped invoice-show-tbl">
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
                                <td class="right">&#8377; {{$item->price}}</td>
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
                    <div class="col-lg-5 col-sm-5 ml-auto">
                        <table class="table table-clear table-invoiceTotal total-tbl">
                            <tbody>
                                <tr>
                                    <td class="left border-top-0">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right border-top-0" width="130">&#8377; {{$invoice->sub_tot_amt}}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Discount</strong>
                                    </td>
                                    <td class="right">{!!isset($invoice->discount_type) && $invoice->discount_type ==0 ? '&#8377;' : ''!!} {{$invoice->discount}} {{isset($invoice->discount_type) && $invoice->discount_type ==1 ? '%' : ''}}</td>
                                </tr>
                                <tr>
                                    <td class="left grandTotalAmount">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right grandTotalAmount">
                                        <strong>&#8377; {{$invoice->grand_total}}</strong>
                                    </td>
                                </tr>
                                @if(count($invoice->payments))
                                    @foreach($invoice->payments as $payment)
                                    <tr>
                                        <td class="left">
                                            Payment on {{ $payment->payment_date}} using
                                            @if($payment->payment_method == 1)
                                            Bank Payment :
                                            @elseif($payment->payment_method == 2)
                                            Cash :
                                            @elseif($payment->payment_method == 3)
                                            Cheque :
                                            @elseif($payment->payment_method == 4)
                                            Credit Card :
                                            @else
                                            Other :
                                            @endif
                                        </td>
                                        <td class="right">
                                            <strong>&#8377; {{$payment->amount}}</strong>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr class="rowAmountDue">
                                        <td class="left">
                                            <strong>Amount Due (INR):</strong>
                                        </td>
                                        <td class="right">
                                            <strong>&#8377; {{$invoice->remaining_amount}}</strong>
                                        </td>
                                    </tr>

                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('sales.invoices.partials.modals')

@endsection
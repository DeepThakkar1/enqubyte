@extends('layouts.app')

@section('content')
<div class="container-fluid pl-md-0 pr-md-0 ml-md-0 mr-md-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content"><span>
            <a href="/customers" class="btn btn-sm text-primary"><i class="fa fa-arrow-left"></i></a>
            <a href="/home"> Home  </a>
            <a href="/customers"><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> Customers</a>
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> {{$visitor->fullname}}
        </h2>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-tabular" role="tabpanel" aria-labelledby="pills-tabular-tab">
            <div class="container px-5">
                <div class="d-flex align-self-center">
                    <div class="py-2">
                        <div>Customer</div>
                        <h3><a href="" class="text-primary"> {{$visitor->fullname}}</a></h3>
                    </div>
                    <div class="ml-auto p-2">
                        <div class="d-flex">
                            <div class="px-4 text-center">
                                <div>Total Enquiries</div>
                                <h3>{{ $enquiriesCount }}</h3>
                            </div>
                            <div class="px-4 text-center">
                                <div>Total Invoices</div>
                                <h3>{{ $invoicesCount }}</h3>
                            </div>
                            <div class="px-4 text-center">
                                <div>Total Earnings</div>
                                <h3>&#8377; {{ $totalSale }}</h3>
                            </div>
                            <div class="px-4 text-center">
                                <div>Total Earn</div>
                                <h3>&#8377; {{$totalSale - $remaining}}</h3>
                            </div>
                            <div class="px-4 text-center">
                                <div>Total Remaining</div>
                                <h3>&#8377; {{$remaining}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container px-5 mt-3">
                <div class="card">
                    <div class="card-header">
                        <strong>Enquiries</strong>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">Enquiry No.</th>
                                        <th>Invoice No.</th>
                                        <th>Date</th>
                                        <th>Followup Date</th>
                                        <th class="right">Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enquiries as $key => $enquiry)
                                    <tr>
                                        <td><a href="/enquiries/{{$enquiry->sr_no}}" target="_blank" class="text-primary">ENV-00{{$enquiry->sr_no}}</a></td>
                                        <td>
                                            @if(isset($enquiry->invoice))
                                            <a href="/sales/invoices/{{$enquiry->invoice->sr_no}}" target="_blank" class="text-primary">INV-00{{$enquiry->invoice->sr_no}}</a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>{{$enquiry->enquiry_date}}</td>
                                        <td>{{$enquiry->followup_date}}</td>
                                        <td>{{$enquiry->grand_total}}</td>
                                        <td><span class="badge badge-{{$enquiry->status == -1 ? 'danger' : ($enquiry->status == 1 ? 'success' : 'warning')}}">{{$enquiry->status == -1 ? 'Cancelled' : ($enquiry->status == 1 ? 'Converted' : 'Pending')}}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <strong>Invoices</strong>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="product-list-menu">
                                        <th>Invoice No.</th>
                                        <th>Enquiry No.</th>
                                        <th>Date</th>
                                        <th>Due Date</th>
                                        <th>Total Amount</th>
                                        <th>Remaining Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoices as $key => $invoice)
                                    <tr>
                                        <td><a href="/sales/invoices/{{$invoice->sr_no}}" target="_blank" class="text-primary">INV-00{{$invoice->sr_no}}</a></td>
                                        <td>
                                            @if(isset($invoice->enquiry))
                                            <a href="/enquiries/{{$invoice->enquiry->sr_no}}" target="_blank" class="text-primary">ENQ-00{{$invoice->enquiry->sr_no}}</a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>{{$invoice->invoice_date}}</td>
                                        <td>{{$invoice->due_date}}</td>
                                        <td>&#8377; {{$invoice->grand_total}}</td>
                                        <td>&#8377; {{$invoice->remaining_amount}}</td>
                                        <td><span class="badge badge-{{$invoice->remaining_amount ? 'warning' : 'success'}}"> {{$invoice->remaining_amount ? 'Pending' : 'Completed'}}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-chart" role="tabpanel" aria-labelledby="pills-chart-tab">
            Chart
        </div>
    </div>
</div>
@endsection
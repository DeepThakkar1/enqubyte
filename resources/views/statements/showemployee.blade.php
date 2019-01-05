@extends('layouts.app')

@section('content')
<div class="container-fluid pl-md-0 pr-md-0 ml-md-0 mr-md-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content"><span>
            <a href="/statements/salesman" class="btn btn-sm text-primary"><i class="fa fa-arrow-left"></i></a>
            <a href="/home"> Home  </a>
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> Statements
            <a href="/statements/salesman"><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> Salesman</a>
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> {{$employee->fullname}}
        </h2>
    </div>
    <div class="container px-5">
        <div class="d-flex align-self-center">
            <div class="py-2">
                <div>Salesman</div>
                <h3><a href="" class="text-primary"> {{$employee->fullname}}</a></h3>
            </div>
            <div class="ml-auto p-2">
                <div class="d-flex">
                    <div class="px-4 text-center">
                        <div>Total Enquiries</div>
                        <h3>{{ count($employee->enquiries)}}</h3>
                    </div>
                    <div class="px-4 text-center">
                        <div>Total Invoices</div>
                        <h3>{{ count($employee->invoices)}}</h3>
                    </div>
                    <div class="px-4 text-center">
                        <div>Total Earnings</div>
                        <h3>&#8377; {{$employee->total_earnings}}</h3>
                    </div>
                    <div class="px-4 text-center">
                        <div>Total Earn</div>
                        <h3>&#8377; {{$employee->total_earnings - $employee->total_remaining}}</h3>
                    </div>
                    <div class="px-4 text-center">
                        <div>Total Remaining</div>
                        <h3>&#8377; {{$employee->total_remaining}}</h3>
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
                                <th>Date</th>
                                <th>Followup Date</th>
                                <th>Details</th>
                                <th class="right">Amount</th>
                                <th>Status</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee->enquiries as $key => $enquiry)
                            <tr>
                                <td>{{$enquiry->id}}</td>
                                <td>{{$enquiry->enquiry_date}}</td>
                                <td>{{$enquiry->followup_date}}</td>
                                <td><a href="/enquiries/{{$enquiry->id}}" target="_blank"># Enquiry {{$enquiry->id}}</a></td>
                                <td>{{$enquiry->grand_total}}</td>
                                <td><span class="badge badge-{{$enquiry->status == -1 ? 'danger' : ($enquiry->status == 1 ? 'success' : 'warning')}}">{{$enquiry->status == -1 ? 'Cancelled' : ($enquiry->status == 1 ? 'Converted' : 'Pending')}}</span></td>
                                <td>
                                    @if(isset($enquiry->invoice))
                                    <a href="/sales/invoices/{{$enquiry->invoice->id}}" target="_blank"># Invoice {{$enquiry->invoice->id}}</a>
                                    @else
                                    -
                                    @endif
                                </td>
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
                                <th>Date</th>
                                <th>Due Date</th>
                                <th>Details</th>
                                <th>Amount</th>
                                <th>Incentive</th>
                                <th>Status</th>
                                <th>Enquiry</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee->invoices as $key => $invoice)
                            <tr>
                                <td>{{$invoice->id}}</td>
                                <td>{{$invoice->invoice_date}}</td>
                                <td>{{$invoice->due_date}}</td>
                                <td><a href="/sales/invoices/{{$invoice->id}}" target="_blank"># Invoice {{$invoice->id}}</a></td>
                                <td>&#8377; {{$invoice->grand_total}}</td>
                                <td>&#8377; {{isset($invoice->incentive) ? $invoice->incentive->incentive_amount : '0'}}</td>
                                <td><span class="badge badge-warning">Pending</span> </td>
                                <td>
                                    @if(isset($invoice->enquiry))
                                    <a href="/sales/invoices/{{$invoice->enquiry->id}}" target="_blank"># Enquiry {{$invoice->enquiry->id}}</a>
                                    @else
                                    -
                                    @endif
                                </td>
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
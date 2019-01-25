@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0 ml-0 mr-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content ">
            <a href="/products" class="mr-1"><i class="fa fa-arrow-left"></i></a>
            <a href="/home"> Home  </a>
            <a href="/products"><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Products</a>
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> {{$product->name}}
        </h2>
    </div>
    <div class="tab-content mt-4" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-tabular" role="tabpanel" aria-labelledby="pills-tabular-tab">
            <div class="container-fluid px-md-5 mb-3">
                <div class="status-user-amount-desktop">
                    <div class="d-flex align-self-center">
                        <div class="py-2">
                            <h3 class="mb-0"><a href="" class="text-primary custom-primary-text"> {{str_limit($product->name, 40)}}</a></h3>
                              <p style="font-weight: 400;font-size: 17px;color:#000;">
                               <b style="font-weight: 500;">{{ $product->product_code }}</b>
                            </p>
                        </div>
                        <div class="ml-auto p-2">
                            <div class="d-flex">
                                <div class="px-4 text-center">
                                    <div><b>Quantity Sold</b></div>
                                    <h3 class="mt-2 Due">{{$qtySold}}</h3>
                                </div>
                                <div class="pl-4 text-center">
                                    <div><b>Total Sale</b></div>
                                    <h3 class="mt-2 Due">&#8377; {{number_format($productTotal)}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid px-md-5 status-user-amount-responsive">
               <div class="d-flex justify-content-between">
                    <div class="py-2 text-left">
                        <div>Product</div>
                        <h3><a href="" class="text-primary custom-primary-text"> {{str_limit($product->name, 40)}}</a></h3>
                    </div>
                    <div class="py-2 text-right">
                        <div>Quantity Sold</div>
                        <h3 class="mt-2 Due">{{$qtySold}}</h3>
                    </div>
               </div>
               <div class="d-flex justify-content-between">
                    <div class="py-2 text-left">
                        <div>Total Sale</div>
                        <h3 class="mt-2 Due">&#8377; {{number_format($productTotal)}}</h3>
                    </div>
                </div>
           </div>

            <div class="container-fluid px-md-5">
                <div class="card">
                    <div class="card-header">
                        <strong>Enquiries ( {{ count($enquiries)}} )</strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive-sm">
                            <table class="table table-striped custom-show-table mb-0">
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
                                        <td><a href="/enquiries/{{$enquiry->sr_no}}" target="_blank" class="text-primary">ENQ-00{{$enquiry->sr_no}}</a></td>
                                        <td>
                                            @if(isset($enquiry->invoice))
                                            <a href="/sales/invoices/{{$enquiry->invoice->sr_no}}" target="_blank" class="text-primary">INV-00{{$enquiry->invoice->sr_no}}</a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>{{$enquiry->enquiry_date}}</td>
                                        <td>{{$enquiry->followup_date}}</td>
                                        <td>&#8377; {{number_format($enquiry->grand_total)}}</td>
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
                        <strong>Invoices ( {{ count($invoices)}} )</strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table custom-show-table mb-0">
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
                                        <td>&#8377; {{number_format($invoice->grand_total)}}</td>
                                        <td>&#8377; {{number_format($invoice->remaining_amount)}}</td>
                                        <td><span class="badge badge-{{$invoice->remaining_amount > 0 ? 'warning' : 'success'}}">{{$invoice->remaining_amount > 0 ? 'Pending' : 'Completed'}}</span></td>
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
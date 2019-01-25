@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0 ml-0 mr-0">
    <div class="headline-contents">
        <h2 class="d-inline-block headline-content "><span>
            <a href="/vendors" class="mr-1"><i class="fa fa-arrow-left"></i></a>
            <a href="/home"> Home  </a>
            <a href="/vendors"><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Vendors</a>
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> {{$vendor->name}}
        </h2>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-tabular" role="tabpanel" aria-labelledby="pills-tabular-tab">
            <div class="container px-md-5 status-user-amount-desktop">
                <div class="d-flex align-self-center">
                    <div class="py-2">
                        <div>Vendor</div>
                        <h3><a href="" class="text-primary custom-primary-text"> {{$vendor->name}}</a></h3>
                    </div>
                    <div class="ml-auto p-2">
                        <div class="d-flex">
                            <div class="px-md-4 text-center">
                                <div>Total Purchase Orders</div>
                                <h3 class="mt-2 Due">{{ $purchasesCount }}</h3>
                            </div>
                            <div class="px-4 text-center">
                                <div>Total Purchases</div>
                                <h3 class="mt-2 Due">&#8377; {{ number_format($totalPurchase) }}</h3>
                            </div>
                            <div class="pl-md-4 text-center">
                                <div>Total Remaining</div>
                                <h3 class="mt-2 Due">&#8377; {{ number_format($remaining) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container px-md-5 status-user-amount-responsive">
               <div class="d-flex justify-content-between">
                    <div class="py-2 text-left">
                        <div>Vendor</div>
                        <h3><a href="" class="text-primary custom-primary-text"> {{$vendor->name}}</a></h3>
                    </div>
                    <div class="py-2 text-right">
                        <div>Total Purchase Orders</div>
                        <h3 class="mt-2 Due">{{ $purchasesCount }}</h3>
                    </div>
               </div>
               <div class="d-flex justify-content-between">
                    <div class="py-2 text-left">
                        <div>Total Purchases</div>
                        <h3 class="mt-2 Due">&#8377; {{ number_format($totalPurchase) }}</h3>
                    </div>
                    <div class="py-2 text-right">
                        <div>Total Remaining</div>
                        <h3 class="mt-2 Due">&#8377; {{ number_format($remaining) }}</h3>
                    </div>
               </div>
           </div>



            <div class="container px-md-5 mt-4">
                <div class="card">
                    <div class="card-header">
                        <strong>Orders</strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive-sm">
                            <table class="table table-striped custom-show-table mb-0">
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
                                    @foreach($purchases as $key => $purchase)
                                    <tr>
                                        <td><a href="/purchases/{{$purchase->sr_no}}" target="_blank" class="text-primary">P/O 00{{$purchase->sr_no}}</a></td>
                                        <td>{{$purchase->order_id}}</td>
                                        <td>{{$purchase->purchase_date}}</td>
                                        <td>{{$purchase->due_date}}</td>
                                        <td>&#8377; {{number_format($purchase->grand_total)}}</td>
                                        <td>&#8377; {{number_format($purchase->remaining_amount)}}</td>
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
        <div class="tab-pane fade" id="pills-chart" role="tabpanel" aria-labelledby="pills-chart-tab">
            Chart
        </div>
    </div>
</div>
@endsection
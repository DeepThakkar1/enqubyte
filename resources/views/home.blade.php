@extends('layouts.app')

@section('content')

<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents" style="border-bottom: 1px solid #f0f0f0;">
        <h2 class="d-inline-block headline-content">Dashboard</h2>
    </div>

    <div class="row m-3">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <h5 class="mr-5 my-2">Total Enquiries</h5>
                    <h5 class="mr-5">{{$enquiriesCnt}}</h5>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/enquiries">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <h5 class="mr-5 my-2">Total Sales</h5>
                    <h5 class="mr-5">&#8377; {{$totalSale}}</h5>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/sales/invoices">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <h5 class="mr-5 my-2">Total Expenses</h5>
                    <h5 class="mr-5">&#8377; {{$expenses}}</h5>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/purchases">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <h5 class="mr-5 my-2">Profit Earned</h5>
                    <h5 class="mr-5">&#8377; {{$profit}}</h5>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/statements/profitandloss">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="row m-3">
        <div class="col-xl-5 col-sm-5 mb-3">
            <ul class="list-group">
                <li class="list-group-item bg-light d-flex justify-content-between align-items-center">
                    <h5 class="m-0">Today's Followups</h5>
                </li>
                @if(count($followups))
                    @foreach($followups as $followup)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                        <div class="mb-1 font-weight-bold">{{str_limit($followup->customer->fullname, 30)}}</div>
                        <a href="/enquiries/{{$followup->sr_no}}" class="text-primary">ENQ-00{{$followup->sr_no}}</a>
                        <div class="text-muted"><small><i class="fa fa-calendar"></i> {{$followup->followup_date}}  {{$followup->followup_time}}</small></div>
                        </div>
                        <a href="tel:{{$followup->customer->phone}}" class="btn btn-sm btn-outline-primary float-right"><i class="fa fa-phone"></i> {{$followup->customer->phone}}</a>
                    </li>
                    @endforeach
                @else
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <h4>No Follow-ups Today!</h4>
                </li>
                @endif
            </ul>
        </div>
        <div class="col-xl-7 col-sm-7 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Statistics</h5>
                </div>
                <div class="card-body">
                    <canvas id="dashboardBarChart" width="100%"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @include('components.demo.demomodal') --}}
@endsection

@push('js')
<script src="{{asset('js/Chart.bundle.js')}}"></script>
<script src="{{asset('js/utils.js')}}"></script>
<script>
var color = Chart.helpers.color;
    var config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        {{$cancelledEnqCnt}},
                        {{$convertedEnqCnt}},
                        {{$pendingEnqCnt}},
                    ],
                    backgroundColor: [
                        window.chartColors.red,
                        window.chartColors.green,
                        window.chartColors.yellow,
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    'Cancelled Enquiries',
                    'Converted Enquiries',
                    'Pending Enquiries'
                ]
            },
            options: {
                responsive: true
            }
        };

        window.onload = function() {
            var ctx = document.getElementById('dashboardBarChart').getContext('2d');
            window.myPie = new Chart(ctx, config);
        };

</script>
@endpush
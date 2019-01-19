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
                <a class="card-footer text-white clearfix small z-1" href="/statements/profitandloss">
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
                    <h4 class="m-0">Today's Followups</h4>
                </li>
                @foreach($followups as $followup)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                    <div class="mb-1 font-weight-bold">{{str_limit($followup->customer->fullname, 30)}}</div>
                    <a href="/enquiries/{{$followup->sr_no}}" class="text-primary">ENQ-00{{$followup->sr_no}}</a>
                    </div>
                    <a href="tel:{{$followup->customer->phone}}" class="btn btn-sm btn-outline-primary float-right">{{$followup->customer->phone}}</a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col-xl-7 col-sm-7 mb-3">
            <div class="card">
                <div class="card-body">
                    <canvas id="myAreaChart" width="100%" height="30"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.demo.demomodal')
@endsection

@push('js')
<script src="{{asset('js/Chart.bundle.js')}}"></script>
<script src="{{asset('js/utils.js')}}"></script>
<script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Mar 1", "Mar 2", "Mar 3", "Mar 4", "Mar 5", "Mar 6", "Mar 7", "Mar 8", "Mar 9", "Mar 10", "Mar 11", "Mar 12", "Mar 13"],
    datasets: [{
      label: "Sessions",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 50,
      pointBorderWidth: 2,
      data: [10000, 30162, 26263, 18394, 18287, 28682, 31274, 33259, 25849, 24159, 32651, 31984, 38451],
  }],
},
options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
      },
      gridLines: {
          display: false
      },
      ticks: {
          maxTicksLimit: 7
      }
  }],
  yAxes: [{
    ticks: {
      min: 0,
      max: 40000,
      maxTicksLimit: 5
  },
  gridLines: {
      color: "rgba(0, 0, 0, .125)",
  }
}],
},
legend: {
  display: false
}
}
});
</script>
@endpush
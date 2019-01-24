@extends('layouts.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents ">
        <h2 class="d-inline-block headline-content">
            <a href="/home"> Home  </a>
            <a href="/reports"><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Reports</a>
            <i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i> Monthly
        </h2>
    </div>
    <div class="card border-0">
        <div class="card-body dashboard-box">
            <div class="headline">
                <h3><i class="icon-feather-bar-chart-2 text-success font-weight-bold"></i> Your Monthly Revenue</h3>
            </div>
            <div class="content">
                <canvas id="chart" width="725" height="326" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
    </div>

@push('js')
<script src="{{asset('js/Chart.bundle.js')}}"></script>
<script src="{{asset('js/utils.js')}}"></script>
<script>
    Chart.defaults.global.defaultFontFamily = "Nunito";
  Chart.defaults.global.defaultFontColor = '#888';
  Chart.defaults.global.defaultFontSize = '14';

  var ctx = document.getElementById('chart').getContext('2d');

  var chart = new Chart(ctx, {
    type: 'line',

    // The data for our dataset
    data: {
      labels: ,
      // Information about the dataset
      datasets: [{
        label: "Revenue in Rs.",
        backgroundColor: 'rgba(42,65,232,0.08)',
        borderColor: '#2a41e8',
        borderWidth: "3",
        data: ,
        pointRadius: 5,
        pointHoverRadius:5,
        pointHitRadius: 10,
        pointBackgroundColor: "#fff",
        pointHoverBackgroundColor: "#fff",
        pointBorderWidth: "2",

    }]
},

    // Configuration options
    options: {

        layout: {
          padding: 10,
      },

      legend: { display: false },
      title:  { display: false },

      scales: {
        yAxes: [{
          scaleLabel: {
            display: false
        },
         ticks: {
                stepSize: 200
            },
        gridLines: {
         borderDash: [6, 10],
         color: "#d8d8d8",
         lineWidth: 1,
     },
 }],
 xAxes: [{
  scaleLabel: { display: false },
  gridLines:  { display: false },
}],
},

tooltips: {
  backgroundColor: '#333',
  titleFontSize: 13,
  titleFontColor: '#fff',
  bodyFontColor: '#fff',
  bodyFontSize: 13,
  displayColors: false,
  xPadding: 10,
  yPadding: 10,
  intersect: false
}
},


});
</script>
@endpush
</div>

@endsection


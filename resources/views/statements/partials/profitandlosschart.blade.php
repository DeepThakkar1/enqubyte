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
    var color = Chart.helpers.color;
    var barChartData = {
      // labels: ['Total Purchase Made', 'Incentives Paid', 'Total Sale', 'Net Profit'],
      datasets: [{
        label: 'Expenses',
        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
        borderColor: window.chartColors.red,
        borderWidth: 1,
        data: [
          {{$expenses}}
        ]
      }, {
        label: 'Total Sale',
        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: [
          {{$totalSale}}
        ]
      }, {
        label: 'Net Profit',
        backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
        borderColor: window.chartColors.green,
        borderWidth: 1,
        data: [
          {{$profit}}
        ]
      }]

    };

      var ctx = document.getElementById('chart').getContext('2d');
      window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
          }
        }
      });
</script>
@endpush
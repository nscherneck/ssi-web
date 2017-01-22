@extends('layout')

@section('title', 'SSI-Extranet | Service')

@section('head')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['System Type', 'Quantity'],
        ['Clean Agent', {{ $quantitySystemType[0] }}],
        ['Fire Alarm', {{ $quantitySystemType[1] }}],
        ['Inert Gas', {{ $quantitySystemType[2] }}],
        ['Dry Chemical', {{ $quantitySystemType[3] }}],
        ['Wet Chemical', {{ $quantitySystemType[4] }}],
        ['Aerosol',{{ $quantitySystemType[5] }}],
        ['Fire Sprinkler (wet)', {{ $quantitySystemType[6] }}],
        ['Fire Sprinkler (dry)', {{ $quantitySystemType[7] }}],
        ['Fire Sprinkler (preaction)', {{ $quantitySystemType[8] }}],
        ['Fire Sprinkler (deluge)', {{ $quantitySystemType[9] }}],
        ['Fire Sprinkler (foam)', {{ $quantitySystemType[10] }}],
        ['Fire Extinguisher', {{ $quantitySystemType[11] }}],
        ['Low-Pressure CO2', {{ $quantitySystemType[12] }}],
        ['High-Pressure CO2', {{ $quantitySystemType[13] }}],
        ['Air Sampling', {{ $quantitySystemType[14] }}],
        ['High-Expansion Foam', {{ $quantitySystemType[15] }}],
        ['Watermist', {{ $quantitySystemType[16] }}],
        ['Backflow Preventer', {{ $quantitySystemType[17] }}]
      ]);

      var options = {
        title: 'Systems ({{ $quantityTotal }})',
        pieHole: 0.4,
        pieStartAngle: 220
      };

      var chart = new google.visualization.PieChart(document.getElementById('donutchart'));

      chart.draw(data, options);

    }
  </script>

@stop

@section('content')

@include('partials.nav')

<div class="container-fluid">

  <br>
  <a href="/customers">Customers Index</a> | <a href="/sites">Sites Index</a>
  <br><br>

<div class="row">

  <div class="col-lg-9">

    <!-- Google Visualization donut chart -->

    <div class="panel panel-default">
    <div class="panel-heading">Total Systems</div>
      <div class="panel-body">

        <div id="donutchart" style="width: 800px; height: 380px;"></div>

      </div>
    </div>

    <!-- end -->

    <canvas id="myBarChart" height="300"></canvas>

    <script type="text/javascript">
      var ctx = document.getElementById("myBarChart");
      var myBarChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: ["-11", "-10", "-9", "-8", "-7", "-6", "-5", "-4", "-3", "-2", "-1", "This Month"],
              datasets: [{
                  label: '# of Tests',
                  data: [
                    {{ $testsTotalTrailingTwelve[11] }},
                    {{ $testsTotalTrailingTwelve[10] }},
                    {{ $testsTotalTrailingTwelve[9] }},
                    {{ $testsTotalTrailingTwelve[8] }},
                    {{ $testsTotalTrailingTwelve[7] }},
                    {{ $testsTotalTrailingTwelve[6] }},
                    {{ $testsTotalTrailingTwelve[5] }},
                    {{ $testsTotalTrailingTwelve[4] }},
                    {{ $testsTotalTrailingTwelve[3] }},
                    {{ $testsTotalTrailingTwelve[2] }},
                    {{ $testsTotalTrailingTwelve[1] }},
                    {{ $testsTotalTrailingTwelve[0] }}
                  ],
                  backgroundColor: [
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(54, 162, 235, 0.2)'
                  ],
                  borderColor: [
                      'rgba(54, 162, 235, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(54, 162, 235, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });

    </script>


  </div>
</div>

</div>

@stop

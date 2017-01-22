@extends('layout')

@section('title', 'SSI-Extranet | Service')

@section('head')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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

// -----------------------------------------

google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Month', 'Quantity of Tests'],
          ['-11', {{ $testsTotalTrailingTwelve[11] }}],
          ['-10', {{ $testsTotalTrailingTwelve[10] }}],
          ['-9', {{ $testsTotalTrailingTwelve[9] }}],
          ['-8', {{ $testsTotalTrailingTwelve[8] }}],
          ['-7', {{ $testsTotalTrailingTwelve[7] }}],
          ['-6', {{ $testsTotalTrailingTwelve[6] }}],
          ['-5', {{ $testsTotalTrailingTwelve[5] }}],
          ['-4', {{ $testsTotalTrailingTwelve[4] }}],
          ['-3', {{ $testsTotalTrailingTwelve[3] }}],
          ['-2', {{ $testsTotalTrailingTwelve[2] }}],
          ['-1', {{ $testsTotalTrailingTwelve[1] }}],
          ['This Month', {{ $testsTotalTrailingTwelve[0] }}],
        ]);

        var options = {
          width: 900,
          axes: {
            y: {
              distance: {label: 'Quantity'}, // Left y-axis.
            }
          }
        };

      var chart = new google.charts.Bar(document.getElementById('dual_y_div'));
      chart.draw(data, options);
    };

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

  <div class="col-sm-6">


<div class="panel panel-default">
<div class="panel-heading">Total Systems</div>
  <div class="panel-body">

    <div id="donutchart" style="width: 800px; height: 380px;"></div>

  </div>
</div>

<div class="panel panel-default">
<div class="panel-heading">Tests By Month (Trailing 12)</div>
  <div class="panel-body">

    <div id="dual_y_div" style="width: 800px; height: 380px;"></div>

  </div>
</div>

</div>

</div>

</div>

@stop

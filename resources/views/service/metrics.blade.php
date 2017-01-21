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
        ['Fire Alarm', {{ $quantityFireAlarm }}],
        ['Clean Agent', {{ $quantityCleanAgent }}],
        ['Inert Gas', {{ $quantityInertGas }}],
        ['Dry Chemical', {{ $quantityDryChem }}],
        ['Wet Chemical', {{ $quantityWetChem }}],
        ['Aerosol',{{ $quantityAerosol }}],
        ['Fire Sprinkler (wet)', {{ $quantityFireSrinklerWet }}],
        ['Fire Sprinkler (dry)', {{ $quantityFireSrinklerDry }}],
        ['Fire Sprinkler (preaction)', {{ $quantityFireSrinklerPreaction }}],
        ['Fire Sprinkler (deluge)', {{ $quantityFireSrinklerDeluge }}],
        ['Fire Sprinkler (foam)', {{ $quantityFireSrinklerFoam }}],
        ['Fire Extinguisher', {{ $quantityFEX }}],
        ['Low-Pressure CO2', {{ $quantityLoCO2 }}],
        ['High-Pressure CO2', {{ $quantityHiCO2 }}],
        ['Air Sampling', {{ $quantityAirSampling }}],
        ['High-Expansion Foam', {{ $quantityHEF }}],
        ['Watermist', {{ $quantityWatermist }}],
        ['Backflow Preventer', {{ $quantityBackflow }}]
      ]);

      var options = {
        title: 'Systems'
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }
  </script>

@section('content')

@include('partials.nav')

<div class="container-fluid">

  <br>
  <a href="/customers">Customers Index</a> | <a href="/sites">Sites Index</a>
  <br><br>

  <div id="piechart" style="width: 800px; height: 500px;"></div>

</div>

@stop

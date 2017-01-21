@extends('layout')

@section('title', 'SSI-Extranet | Service')

@section('content')

@include('partials.nav')

<div class="container-fluid">

  <br>
  <a href="/customers">Customers Index</a> | <a href="/sites">Sites Index</a>
  <br><br>

  <p>
    Fire Alarm: {{ $quantityFireAlarm }}<br>
    Clean Agent: {{ $quantityCleanAgent }}<br>
    Inert Gas: {{ $quantityInertGas }}<br>
    Dry Chemical: {{ $quantityDryChem }}<br>
    Wet Chemical: {{ $quantityWetChem }}<br>
    Aerosol: {{ $quantityAerosol }}<br>
    Fire Sprinker (wet): {{ $quantityFireSrinklerWet }}<br>
    Fire Sprinkler (dry): {{ $quantityFireSrinklerDry }}<br>
    Fire Sprinkler (preaction): {{ $quantityFireSrinklerPreaction }}<br>
    Fire Sprinkler (deluge): {{ $quantityFireSrinklerDeluge }}<br>
    Fire Sprinkler (foam): {{ $quantityFireSrinklerFoam }}<br>
    Fire Extinguisher: {{ $quantityFEX }}<br>
    Low-Pressure CO2: {{ $quantityLoCO2 }}<br>
    High-Pressure CO2: {{ $quantityHiCO2 }}<br>
    Air Sampling: {{ $quantityAirSampling }}<br>
    High-Expansion Foam: {{ $quantityHEF }}<br>
    Watermist: {{ $quantityWatermist }}<br>
    Backflow Preventer: {{ $quantityBackflow }}<br>
  </p>

</div>

@stop

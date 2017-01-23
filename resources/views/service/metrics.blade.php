@extends('layout')

@section('title', 'SSI-Extranet | Service')

@section('head')

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>

@stop

@section('content')

@include('partials.nav')

<div class="container-fluid">

  <br>
  <a href="/customers">Customers Index</a> | <a href="/sites">Sites Index</a>
  <br><br>

<div class="row">

  <div class="col-lg-4">

    <div class="panel panel-default panel-info">
    <div class="panel-heading"><i class="fa fa-bar-chart" aria-hidden="true"></i> Total Systems by Type ({{ $quantityTotal }})</div>
      <div class="panel-body">
        <div>
          <canvas id="myDonutChart" width="500" height="300"></canvas>
        </div>
      </div>
    </div>

  </div>

  <div class="col-lg-4">

    <script type="text/javascript">

    var ctx1 = document.getElementById("myDonutChart");

    Chart.defaults.global.legend.display = false;

    var donutdata = {
      labels: [
        "Clean Agent",
        "Fire Alarm",
        "Inert Gas",
        "Dry Chemical",
        "Wet Chemical",
        "Aerosol",
        "Fire Sprinkler (wet)",
        "Fire Sprinkler (dry)",
        "Fire Sprinkler (preaction)",
        "Fire Sprinkler (deluge)",
        "Fire Sprinkler (foam)",
        "Fire Extinguisher",
        "Low-Pressure CO2",
        "High-Pressure CO2",
        "Air Sampling",
        "High-Expansion Foam",
        "Watermist",
        "Backflow Preventer"
      ],
    datasets: [
        {
            data: [
              {{ $quantitySystemType[0] }},
              {{ $quantitySystemType[1] }},
              {{ $quantitySystemType[2] }},
              {{ $quantitySystemType[3] }},
              {{ $quantitySystemType[4] }},
              {{ $quantitySystemType[5] }},
              {{ $quantitySystemType[6] }},
              {{ $quantitySystemType[7] }},
              {{ $quantitySystemType[8] }},
              {{ $quantitySystemType[9] }},
              {{ $quantitySystemType[10] }},
              {{ $quantitySystemType[11] }},
              {{ $quantitySystemType[12] }},
              {{ $quantitySystemType[13] }},
              {{ $quantitySystemType[14] }},
              {{ $quantitySystemType[15] }},
              {{ $quantitySystemType[16] }},
              {{ $quantitySystemType[17] }}
            ],
            backgroundColor: [
                "#00bfff",
                "#ff0000",
                "#00ff00",
                "#0040ff",
                "#8000ff",
                "#ff0080",
                "#ff8000",
                "#00ff80",
                "#ffff00",
                "#00ffbf",
                "#cc3333",
                "#ffcccc",
                "#ffe6e6",
                "#bfff00",
                "#8000ff",
                "#ff00ff",
                "#bfff00",
                "#0080ff"
            ],
            hoverBackgroundColor: [
                "#00bfff",
                "#ff0000",
                "#00ff00",
                "#0040ff",
                "#8000ff",
                "#ff0080",
                "#ff8000",
                "#00ff80",
                "#ffff00",
                "#00ffbf",
                "#cc3333",
                "#ffcccc",
                "#ffe6e6",
                "#bfff00",
                "#8000ff",
                "#ff00ff",
                "#bfff00",
                "#0080ff"
            ]
        }]
    };

    var myDonutChart = new Chart(ctx1, {
      type: 'doughnut',
      data: donutdata,
      options: {
          responsive: true,
        }
    });

    </script>

  <div class="panel panel-default panel-info">
  <div class="panel-heading"><i class="fa fa-bar-chart" aria-hidden="true"></i> Tests per Month</div>
    <div class="panel-body">

    <canvas id="myBarChart" width="250" height="150"></canvas>

  </div>
</div>

  <script type="text/javascript">
    var ctx = document.getElementById("myBarChart");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonths(11)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonths(10)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonths(9)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonths(8)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonths(7)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonths(6)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonths(5)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonths(4)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonths(3)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonths(2)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonth()->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->format('F') }}"
              ],
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

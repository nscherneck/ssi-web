@extends('layout')

@section('title', 'SSI-Extranet | Service')

@section('head')

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>

@stop

@section('content')

@include('partials.nav')

<div class="container" style="margin-top: 15px">

  @include('partials.flash')

  <div class="row">

    <div class="col-lg-6 no-gutter-right">

      <div class="panel panel-default panel-info">

        <div class="panel-heading">
          <i class="fa fa-bar-chart" aria-hidden="true"></i> Tests per Month
        </div>

        <div class="panel-body">
          <canvas id="myBarChart" width="250" height="150"></canvas>
        </div>

      </div> <!-- END OF PANEL -->

      @include('scripts.tests_per_month_chart')

    </div> <!-- END OF COLUMN -->

    <div class="col-lg-6 no-gutter-right">

      <div class="panel panel-default panel-info">

        <div class="panel-heading">
          <i class="fa fa-bar-chart" aria-hidden="true"></i> 
          Total Systems by Type ({{ $totalSystemsCount }})
        </div>

        <div class="panel-body">

          <div>
            <canvas id="myDonutChart" width="500" height="300"></canvas>
          </div>

        </div> <!-- END OF PANEL BODY -->
      </div> <!-- END OF PANEL -->

      @include('scripts.systems_by_category_chart')

    </div> <!-- END OF COLUMN -->

  </div> <!-- END OF ROW -->

</div> <!-- END OF CONTAINER -->

@stop


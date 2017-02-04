@extends('layout')

@section('title', 'SSI-Extranet | Service')

@section('head')

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>

@stop

@section('content')

@include('partials.nav')

<div class="container-fluid">

  @include('partials.flash')

  <div class="btn-group btn-group-sm" role="group" aria-label="..." style="margin: 10px 0; text-decoration: none;">
    <a href="/customers" style="text-decoration: none;" type="button" class="btn btn-default">Customers Index</a>
    <a href="/sites" style="text-decoration: none;" type="button" class="btn btn-default">Sites Index</a>
  </div>

  <div class="row">

    <div class="col-lg-4 no-gutter-right">

      <div class="panel panel-default panel-info">
      <div class="panel-heading"><i class="fa fa-bar-chart" aria-hidden="true"></i> Tests per Month</div>
        <div class="panel-body">

        <canvas id="myBarChart" width="250" height="150"></canvas>

      </div>
    </div>

  @include('scripts.tests_per_month_chart')


    <div class="panel panel-default panel-info">
    <div class="panel-heading"><i class="fa fa-bar-chart" aria-hidden="true"></i> Total Systems by Type ({{ $quantityTotal }})</div>
      <div class="panel-body">

        <div>
          <canvas id="myDonutChart" width="500" height="300"></canvas>
        </div>

      </div>
    </div>

  @include('scripts.systems_by_category_chart')

    <div class="panel panel-default panel-info">
    <div class="panel-heading"><i class="fa fa-search" aria-hidden="true"></i> Search Tests by Customer</div>
      <div class="panel-body">

        <form action="/tests/search" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">

          <small>Customer:</small> <select name="customer_id" class="form-control">
              <option value="0">Select Customer</option>
            @foreach ($customers as $customer)
              <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
          </select>
          <br>

          <div class="row">

            <div class="col-lg-6">
              <small>Start Date:</small> <input type="date" name="start_date" value="" class="form-control">
            </div>

            <div class="col-lg-6">
              <small>End Date:</small> <input type="date" name="end_date" value="" class="form-control">
            </div>

          </div> <!-- END OF ROW -->
          <br>

          <button type="submit" class="btn btn-primary pull-right">Search</button>
        </div>
      </form>

      </div>
    </div> <!-- END OF PANEL -->

  </div>

  <div class="col-lg-8">

    <div class="panel panel-info">
        <div class="panel-heading"><i class="fa fa-tag" aria-hidden="true"></i> Systems Due For Test</div>
        <div class="panel-body">

          @include('partials.systems_due_map')

        </div>

      <table class="table table-hover table-condensed" style="font-size: 11px">
        <thead>
          <tr>
            <th>Due</th>
            <th>System</th>
            <th>System Type</th>
            <th>Components</th>
          </tr>
        </thead>
        <tbody>
          @foreach($systemduefortest as $system)
            <tr>
            <td>{{ $system->next_test_date->format('F') }}</td>
            <td>
              <a href="/customer/{{ $system->site->customer->id }}">{{ $system->site->customer->name }}</a>  -
                <a href="/site/{{ $system->site->id }}">{{ $system->site->name }}</a>  -
                  <a href="/system/{{ $system->id }}">{{ $system->name }}</a>
            </td>
            <td>{{ $system->system_type->type }}</td>
            <td>{{ $system->count_components() }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>

  </div>

  <div class="titleBar">
      <p>Recent Tests</p>
  </div>

  <div class="table-responsive">

    <table class="table table-hover table-condensed" style="font-size: 11px">
      <thead>
        <tr>
          <th>Test Date</th>
          <th>Reports</th>
          <th>Technician</th>
          <th>System</th>
          <th>System Type</th>
          <th>Components</th>
          <th>Test Type</th>
          <th>Result</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tests as $test)
          <tr
          <?php echo ($test->test_result->name == 'Pass with Deficiencies') ? "class=\"warning\"" : ""; ?>
          <?php echo ($test->test_result->name == 'Fail with Deficiencies') ? "class=\"danger\"" : ""; ?>
          >
          <td><a href="/tests/{{ $test->id }}">{{ $test->test_date->format('D, F j') }}</a></td>
          <td>{{ $test->reports->count() }}</td>
          <td>{{ $test->technician->first_name }}</a></td>
          <td>
            <a href="/customer/{{ $test->system->site->customer->id }}">{{ $test->system->site->customer->name }}</a>  -
              <a href="/site/{{ $test->system->site->id }}">{{ $test->system->site->name }}</a>  -
                <a href="/system/{{ $test->system->id }}">{{ $test->system->name }}</a>
          </td>
          <td>{{ $test->system->system_type->type }}</td>
          <td>{{ $test->system->count_components() }}</td>
          <td>{{ $test->test_type->name }}</td>
          <td>{{ $test->test_result->name }}</td>

        </tr>
        @endforeach
      </tbody>
    </table>

  </div>

  <div class="titleBar">
    <p>Recently Added Systems</p>
  </div>

  <div class="table-responsive">

    <table class="table table-hover table-condensed" style="font-size: 11px">
      <thead>
        <tr>
          <th>Added</th>
          <th>Customer</th>
          <th>Site</th>
          <th>System</th>
          <th>System Type</th>
          <th>Components</th>
        </tr>
      </thead>
      <tbody>
        @foreach($recentsystems as $system)
          <tr>
            <td>{{ $system->created_at->format('D, F j') }}</td>
            <td><a href="/customer/{{ $system->site->customer->id }}">{{ $system->site->customer->name }}</a></td>
            <td><a href="/site/{{ $system->site->id }}">{{ $system->site->name }}</a></td>
            <td><a href="/system/{{ $system->id }}">{{ $system->name }}</a></td>
            <td>{{ $system->system_type->type }}</td>
            <td>{{ $system->count_components() }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

  </div>

</div>

</div>

@stop

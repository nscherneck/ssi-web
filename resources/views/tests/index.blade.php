@extends('layout')

@section('title', 'SSI-Extranet | Customers Index')

@section('content')

<div class="container-fluid">

  @include('partials.nav')

  <div class="btn-group btn-group-sm" role="group" aria-label="..." style="margin: 10px 0; text-decoration: none;">
    <a href="/customers" style="text-decoration: none;" type="button" class="btn btn-default">Customers Index</a>
    <a href="/sites" style="text-decoration: none;" type="button" class="btn btn-default">Sites Index</a>
  </div>

</div>

<div class="container-fluid">

<div class="row">

  <div class="col-lg-3">

    <div class="panel panel-info">
    <div class="panel-heading">Filter Test Records</div>
    <div class="panel-body">

      <form action="/tests" method="GET">

        <h4>Technician</h4>

          <input type="checkbox" checked="checked"> All<br>
          @foreach ($technicians as $technician)
            <input type="checkbox" name="technician" value="{{ $technician->id }}">
            {{ $technician->first_name }}<br>
          @endforeach
  
        <hr>

        <h4>Date Range (Test Date)</h4>

          <div class="row">

            <div class="col-lg-6">
              <small>Start Date:</small> <input type="date" name="date_range[]" value="2017-01-01" class="form-control" required>
            </div>

            <div class="col-lg-6">
              <small>End Date:</small> <input type="date" name="date_range[]" value="@php echo date('Y-m-d') @endphp" class="form-control" required>
            </div>

          </div> <!-- END OF ROW -->

        <hr>

        <h4>Test Type</h4>

          <input type="checkbox" checked="checked"> All<br>
          @foreach ($test_types as $type)
            <input type="checkbox" name="test_type" value="{{ $type->id }}">
            {{ $type->name }}<br>
          @endforeach
  
        <hr>

        <h4>Test Result</h4>

          <input type="checkbox" checked="checked"> All<br>
          @foreach ($test_results as $result)
            <input type="checkbox" name="test_result" value="{{ $result->id }}">
            {{ $result->name }}<br>
          @endforeach
  
        <hr>

    </div> <!-- END OF PANEL BODY -->

    <div class="panel-footer">
      <button type="submit" class="btn btn-primary">Filter</button>
    </div> <!-- END OF FOOTER -->

    </form>
 
    </div> <!-- END OF PANEL -->
    
  </div> <!-- end of col-3 -->

  <div class="col-lg-9">

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
            <td><a href="/tests/{{ $test->id }}">{{ $test->test_date->format('F j, Y') }}</a></td>
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

  </div> <!-- end of col-9 -->
</div> <!-- end of row -->


</div>

@stop

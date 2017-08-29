@extends('layout')

@section('title', 'SSI-Extranet | Service')

@section('head')

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>

@stop

@section('content')

@include('partials.nav')

<div class="container" style="margin-top: 15px">

  @include('partials.flash')

  <div class="panel panel-info">

    <div class="panel-heading">
    <i class="fa fa-tag" aria-hidden="true"></i> Systems Due For Test
    </div>

    <div class="panel-body" style="padding: 10px;">
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

        @foreach ($systemsDueForTest as $system)
         <tr>

          <td>
          {{ $system->next_test_date->format('F') }}
          </td>
          <td>
            <a href="{{ $system->site->customer->path() }}">
              {{ $system->site->customer->name }}
            </a>
              {{ config('constants.SEPARATOR') }}
            <a href="{{ $system->site->path() }}">
              {{ $system->site->name }}
            </a>
              {{ config('constants.SEPARATOR') }}
            <a href="{{ $system->path() }}">
              {{ $system->name }}
            </a>
          </td>

          <td>{{ $system->systemType->type }}</td>

          <td>{{ $system->components->sum('pivot.quantity') }}</td>

          </tr>
        @endforeach
      </tbody>
    </table>

  </div> <!-- END OF PANEL -->

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
        @foreach ($tests as $test)
        <tr {!! $test->setServiceViewRowColor() !!}>

          <td>
          <a href="/tests/{{ $test->id }}">
          {{ $test->test_date->format('D, F j') }}
          </a>
          </td>

          <td>
          {{ $test->reports->count() }}
          </td>

          <td>
          {{ $test->technician->first_name }}
          </td>

          <td>
            <a href="{{ $test->system->site->customer->path() }}">
            {{ $test->system->site->customer->name }}
            </a>
              {{ config('constants.SEPARATOR') }}
            <a href="{{ $test->system->site->path() }}">
            {{ $test->system->site->name }}
            </a>
              {{ config('constants.SEPARATOR') }}
            <a href="{{ $test->system->path() }}">
            {{ $test->system->name }}
            </a>
          </td>

          <td>{{ $test->system->systemType->type }}</td>

          <td>{{ $test->system->components->sum('pivot.quantity') }}</td>

          <td>{{ $test->testType->name }}</td>

          <td>{{ $test->testResult->name }}</td>

        </tr>
        @endforeach
      </tbody>
    </table>

  </div>

  <div class="panel panel-default panel-info">

    <div class="panel-heading">
    <i class="fa fa-search" aria-hidden="true"></i> Filter Tests
    </div>

    <div class="panel-body">

    <div class="form-group">

      <form action="/tests/search" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="row">

        <div class="col-lg-4">
          <small>Customer:</small>
          <select name="customer_id" class="form-control">
          <option value="0">Select Customer</option>
            @foreach ($customers as $customer)
            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-lg-4">
          <small>Test Result:</small>
          <select name="test_result_id" class="form-control">
          <option value="0">Select Result</option>
            @foreach ($testResults as $result)
            <option value="{{ $result->id }}">{{ $result->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-lg-4">
          <small>System Type:</small>
          <select name="system_type_id" class="form-control">
          <option value="0">Select System Type</option>
            @foreach ($systemTypes as $type)
            <option value="{{ $type->id }}">{{ $type->type }}</option>
            @endforeach
          </select>
        </div>

      </div> <!-- END OF ROW -->

      <br>

      <div class="row">

        <div class="col-lg-3">
          <small>Start Date:</small>
          <input type="date" name="start_date" value="" class="form-control">
        </div>

        <div class="col-lg-3">
          <small>End Date:</small>
          <input type="date" name="end_date" value="" class="form-control">
        </div>

        <div class="col-lg-3">
          <small>Has Reports:</small>
          <select name="has_reports" class="form-control">
          <option value="">Select</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>
        </div>

        <div class="col-lg-3">
        </div>

      </div> <!-- END OF ROW -->


      <button type="submit" class="btn btn-primary pull-right">Search</button>
      </form>

    </div> <!-- END OF FORM GROUP -->
    </div> <!-- END OF PANEL BODY -->

  </div> <!-- END OF PANEL -->

</div> <!-- END OF CONTAINER -->

@stop

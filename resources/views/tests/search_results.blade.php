@extends('layout')

@section('title', 'SSI-Extranet | Tests Search Results')

@section('content')

<div class="container-fluid">

  @include('partials.nav')

</div>

<div class="container-fluid">

  <div class="row">

    <div class="col-lg-8 col-lg-offset-2">

      <div class="panel panel-default panel-info" style="margin-top: 15px">

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
               <br>
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

             <div class="col-lg-3">
               <button type="submit" class="btn btn-primary pull-right">Search</button>
               </form>
             </div>

            </div> <!-- END OF ROW -->
          </div> <!-- END OF FORM GROUP -->
          </div> <!-- END OF PANEL BODY -->

        </div> <!-- END OF PANEL -->
      </div> <!-- END OF COLUMN -->
    </div> <!-- END OF ROW -->

  <div class="titleBar">
    <p>Filtered Tests ({{ $tests->count() }})</p>
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
          <th class="text-center">Components</th>
          <th>Test Type</th>
          <th>Result</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tests as $test)
              <tr {!! $test->setServiceViewRowColor() !!}>

                <td>
                  <a href="{{ $test->path() }}">
                  {{ $test->formatted_test_date }}
                  </a>
                </td>

                <td>{{ $test->reports->count() }}</td>

                <td>{{ $test->technician->first_name }}</a></td>

                <td>
                  <a href="{{ $test->system->site->customer->path() }}">
                    {{ $test->system->site->customer->name }}
                  </a>
                    {{ env('ENTITY_SEPARATOR') }}
                  <a href="{{ $test->system->site->path() }}">
                    {{ $test->system->site->name }}
                  </a>
                    {{ env('ENTITY_SEPARATOR') }}
                  <a href="{{ $test->system->path() }}">
                    {{ $test->system->name }}
                  </a>
                </td>

                <td>{{ $test->system->systemType->type }}</td>

                <td class="text-center">{{ $test->system->components()->sum('quantity') }}</td>

                <td>{{ $test->testType->name }}</td>

                <td>{{ $test->test_result->name }}</td>

              </tr>
    @endforeach
      </tbody>
    </table>

  </div> <!-- END OF RESPONSIVE TABLE DIV -->

</div> <!-- END OF CONTAINER -->

@stop

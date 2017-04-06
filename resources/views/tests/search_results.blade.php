@extends('layout')

@section('title', 'SSI-Extranet | Tests Search Results')

@section('content')

<div class="container-fluid">

  @include('partials.nav')

  <div class="btn-group btn-group-sm" role="group" aria-label="..." style="margin: 10px 0; text-decoration: none;">
    <a href="/customers" style="text-decoration: none;" type="button" class="btn btn-default">Customers Index</a>
    <a href="/sites" style="text-decoration: none;" type="button" class="btn btn-default">Sites Index</a>
  </div>

</div>

<div class="container-fluid">

  <div class="titleBar" style="margin-top: 0">
      <p>Tests Search Results ({{ $tests->count() }})</p>
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
              <tr {!! $test->setServiceViewRowColor() !!}>

                <td>
                  <a href="/tests/{{ $test->id }}">
                  {{ $test->formatted_test_date }}
                  </a>
                </td>

                <td>{{ $test->reports->count() }}</td>

                <td>{{ $test->technician->first_name }}</a></td>

                <td>
                  <a href="/customer/{{ $test->system->site->customer->id }}">
                  {{ $test->system->site->customer->name }}
                  </a>  -
                    <a href="/site/{{ $test->system->site->id }}">
                    {{ $test->system->site->name }}
                    </a>  -
                      <a href="/system/{{ $test->system->id }}">
                      {{ $test->system->name }}
                      </a>
                </td>

                <td>{{ $test->system->system_type->type }}</td>

                <td>{{ $test->system->components()->count() }}</td>

                <td>{{ $test->test_type->name }}</td>

                <td>{{ $test->test_result->name }}</td>

              </tr>
    @endforeach
      </tbody>
    </table>

  </div> <!-- END OF RESPONSIVE TABLE DIV -->

</div> <!-- END OF CONTAINER -->

@stop

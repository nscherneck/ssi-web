<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Report // {{ $test->system->site->customer->name }}</title>
    <link rel="stylesheet" href="{{ $basePath }}/public/css/tests_pdf.css">
</head>
<body>
<table border="0" width=100%>
    <tr>
        <td align="left">
            <p>
            <small>
                <strong>Customer: </strong>{{ $test->system->site->customer->name }}<br>
                <strong>Site: </strong>
                {{ $test->system->site->name }}<br>
                {{ $test->system->site->address1 }}<br>
                {{ $test->system->site->city }},
                {{ $test->system->site->state->abbreviated }} {{ $test->system->site->zip }}<br><br>
                {{ $test->system->site->lat }}, {{ $test->system->site->lon }}
            </small>
            </p>
        </td>
        <td align="right">
            <h5>{{ $test->testType->name }}</h5>
            <p><small><strong>Test Date: </strong>{{ $test->formatted_test_date }}</small></p>
            <p>{{ $test->system->name }}</p>
            <p><strong>System Type: </strong>{{ $test->system->systemType->type }}</p>
        </td>

    </tr>
</table>
@if ($test->system->notes)
    <hr>
    <h4>System Notes</h4>
    <p>
        <small>
        {!! nl2br(e($test->system->notes)) !!}
        </small>
    </p>
@endif
<hr>
@foreach($test->system->getComponent(1) as $panel)
  <table cellpadding="7">
      <tr>
      <small>
          <th align="left">
              <small>Quantity</small>
          </th>
          <th>
              <small>Note</small>
          </th>
          <th>
              <small>Manufacturer</small>
          </th>
          <th>
              <small>Model</small>
          </th>
          <th align="left">
              <small>Description</small>
          </th>
          <th>
              <small>Category</small>
          </th>
      </tr>
      <tr>
          <td>
            <small>{{ $panel->pivot->quantity }}</small>
          </td>
          <td>
            <small>{{ $panel->pivot->name }}</small>
          </td>
          <td>
            <small>{{ $panel->manufacturer->name }}</small>
          </td>
          <td>
            <small>{{ $panel->model }}</small>
          </td>
          <td>
              <small>
                {{ $panel->formatted_description }}
              </small>
          </td>
          <td>
            <small>{{ $panel->componentCategory->name }}</small>
          </td>
      </tr>
  </small>
  </table>
  <hr>
@endforeach
<table border="0" width=100%>
  <tr>
      <td align="left">
          @if ($test->deficiencies->count() > 0)
              <h4>Deficiencies</h4>
              <small>
              <ol>
                  @foreach ($test->deficiencies as $deficiencies)
                      <li>{{ $deficiencies->description }}</li>
                  @endforeach
              </ol>
              </small>
          @endif
      </td>
      <td align="left">
          @if ($test->testNotes->count() > 0)
              <h4>Notes</h4>
              <small>
              <ol>
                  @foreach ($test->testNotes as $testNote)
                      <li>{{ $testNote->note }}</li>
                  @endforeach
              </ol>
              </small>
          @endif
      </td>

  </tr>
</table>
</body>
</html>

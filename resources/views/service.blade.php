@extends('layout')

@section('title', 'SSI-Extranet | Service')

@section('content')

@include('partials.nav')

<div class="container-fluid">
  <br><a href="/customers">Customers Index</a> | <a href="/sites">Sites Index</a>

  <div class="titleBar">
      <p>Recently Completed Tests</p>
  </div>

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


  <div class="row">
    <div class="col-md-6 no-gutter-right">

      <div class="titleBar">
        <p>Recently Added Photos</p>
      </div>

      @if($recentphotos->count() > 0)

      @foreach($recentphotos as $photo)
        <div class="recentSystemPhoto">

          <div class="recentSystemPhotoThumb">
            <a href="/system/photo/{{ $photo->id }}">
              <img src="https://s3-us-west-2.amazonaws.com/ssiwebstorage/customer-data/system_photos/thumbnails/thumb-{{ $photo->file_name }}.{{ $photo->ext }}" alt="{{ $photo->caption }}" width="150" height="auto"/>
            </a>
          </div>

          <div class="recentSystemPhotoContent">
            <p style="font-size: 12px; line-height: 1.75">
              {{ $photo->caption }}<br>

              <strong>
                <a href="/customer/{{ $photo->getSystem($photo->photoable_id)->site->customer->id }}">
                  {{ $photo->getSystem($photo->photoable_id)->site->customer->name }}
                </a></strong> /

              <strong>
                <a href="/site/{{ $photo->getSystem($photo->photoable_id)->site->id }}">
                  {{ $photo->getSystem($photo->photoable_id)->site->name }}
                </a></strong> /

              <strong>
                <a href="/system/{{ $photo->getSystem($photo->photoable_id)->id }}">
                  {{ $photo->getSystem($photo->photoable_id)->name }}
                </a></strong>

                <br>
              <strong>Added By: </strong>{{ $photo->addedBy->first_name }}<br>
              <strong>Added: </strong>{{ $photo->created_at->setTimezone('America/Los_Angeles')->format('l - F j, g:i A') }}<br>
              <strong>Size: </strong>{{ $photo->getSize() }}<br>
            </p>
          </div>

        </div>
      @endforeach

      @endif
    </div>

    <div class="col-md-6">

      <div class="titleBar">
          <p>Systems Due For Test</p>
      </div>

      <table class="table table-hover table-condensed" style="font-size: 11px">
        <thead>
          <tr>
            <th>Due</th>
            <th>System</th>
            <th>System Type</th>
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
          </tr>
          @endforeach
        </tbody>
      </table>


    </div>
  </div>

  <div class="titleBar">
    <p>Recently Added Systems</p>
  </div>

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

@stop

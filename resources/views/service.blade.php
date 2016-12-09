@extends('layout')

@section('title', 'SSI-Web | Service')

@section('content')

@include('partials.nav')

<div class="container-fluid">
  <br><a href="/customers">Customers Index</a> | <a href="/sites">Sites Index</a>

  <div class="titleBar">
      <p>Recently Completed Tests</p>
  </div>

  <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th><small>Test Date</small></th>
        <th><small>Reports</small></th>
        <th><small>Technician</small></th>
        <th><small>System</small></th>
        <th><small>System Type</small></th>
        <th><small>Components</small></th>
        <th><small>Test Type</small></th>
        <th><small>Result</small></th>
      </tr>
    </thead>
    <tbody>
      @foreach($tests as $test)
        <tr
        <?php echo ($test->test_result->name == 'Pass with Deficiencies') ? "class=\"warning\"" : ""; ?>
        <?php echo ($test->test_result->name == 'Fail with Deficiencies') ? "class=\"danger\"" : ""; ?>>
        <td><small><a href="/tests/{{ $test->id }}">{{ $test->test_date->format('D, F j') }}</a></small></td>
        <td><small>{{ $test->reports->count() }}</small></td>
        <td><small>{{ $test->technician->first_name }}</a></small></td>
        <td><small>
          <a href="/customer/{{ $test->system->site->customer->id }}">{{ $test->system->site->customer->name }}</a>  -
            <a href="/site/{{ $test->system->site->id }}">{{ $test->system->site->name }}</a>  -
              <a href="/system/{{ $test->system->id }}">{{ $test->system->name }}</a>
        <small></small></td>
        <td><small>{{ $test->system->system_type->type }}</small></td>
        <td><small>{{ $test->system->count_components() }}</small></td>
        <td><small>{{ $test->test_type->name }}</small></td>
        <td><small>{{ $test->test_result->name }}</small></td>
      </tr>
      @endforeach
    </tbody>
  </table>


  <div class="row">
    <div class="col-md-6 no-gutter-right">

      <div class="titleBar">
        <p>Recently Added Photos</p>
      </div>

      @foreach($recentphotos as $photo)
        <div class="recentSystemPhoto">

          <div class="recentSystemPhotoThumb">
            <a href="/system/photo/{{ $photo->id }}"><img src="https://s3-us-west-2.amazonaws.com/ssiwebstorage/{{ $photo->path }}" alt="{{ $photo->caption }}" width="150" height="auto"/></a>
          </div>

          <div class="recentSystemPhotoContent">
            <p>
              <small>{{ $photo->caption }}</small><br>
              <small><strong><a href="/customer/{{ $photo->getSystem($photo->photoable_id)->site->customer->id }}">{{ $photo->getSystem($photo->photoable_id)->site->customer->name }}</a></strong> /
              <strong><a href="/site/{{ $photo->getSystem($photo->photoable_id)->site->id }}">{{ $photo->getSystem($photo->photoable_id)->site->name }}</a></strong> /
              <strong><a href="/system/{{ $photo->getSystem($photo->photoable_id)->id }}">{{ $photo->getSystem($photo->photoable_id)->name }}</a></strong></small><br>
              <small><strong>Added By: </strong>{{ $photo->addedBy->first_name }}</small><br>
              <small><strong>Added: </strong>{{ $photo->created_at->setTimezone('America/Los_Angeles')->format('l - F j, g:i A') }}</small><br>
              <small><strong>Size: </strong>{{ $photo->getSize() }}</small><br>
            </p>
          </div>

        </div>
      @endforeach
    </div>

    <div class="col-md-6">

      <div class="titleBar">
          <p>Systems Due For Test</p>
      </div>

      <table class="table table-hover table-condensed">
        <thead>
          <tr>
            <th><small>Due</small></th>
            <th><small>System</small></th>
            <th><small>System Type</small></th>
          </tr>
        </thead>
        <tbody>
          @foreach($systemduefortest as $system)
            <tr>
            <td><small>{{ $system->next_test_date->format('F') }}</small></td>
            <td><small>
              <a href="/customer/{{ $system->site->customer->id }}">{{ $system->site->customer->name }}</a>  -
                <a href="/site/{{ $system->site->id }}">{{ $system->site->name }}</a>  -
                  <a href="/system/{{ $system->id }}">{{ $system->name }}</a>
            <small></small></td>
            <td><small>{{ $system->system_type->type }}</small></td>
          </tr>
          @endforeach
        </tbody>
      </table>


    </div>
  </div>

  <div class="titleBar">
    <p>Recently Added Systems</p>
  </div>

  <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th><small>Added</small></th>
        <th><small>Customer</small></th>
        <th><small>Site</small></th>
        <th><small>System</small></th>
        <th><small>System Type</small></th>
        <th><small>Components</small></th>
      </tr>
    </thead>
    <tbody>
      @foreach($recentsystems as $system)
        <tr>
          <td><small>{{ $system->created_at->format('D, F j') }}</small></td>
          <td><small><a href="/customer/{{ $system->site->customer->id }}">{{ $system->site->customer->name }}</a></small></td>
          <td><small><a href="/site/{{ $system->site->id }}">{{ $system->site->name }}</a></small></td>
          <td><small><a href="/system/{{ $system->id }}">{{ $system->name }}</a></small></td>
          <td><small>{{ $system->system_type->type }}</small></td>
          <td><small>{{ $system->count_components() }}</small></td>
        </tr>
      @endforeach
    </tbody>
  </table>


</div>



@stop

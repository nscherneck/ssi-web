@extends('layout')

@section('title', 'SSI-Web | Test')

@section('content')

@include('partials.nav')

@include('partials.flash')

<div class="container-fluid">

  <br>
  <ol class="breadcrumb small">
    <li><a href="/customers">Customers</a></li>
    <li><a href="/customer/{{ $test->system->site->customer->id }}">{{ $test->system->site->customer->name }}</a></li>
    <li><a href="/site/{{ $test->system->site->id }}">{{ $test->system->site->name }}</a></li>
    <li><a href="/system/{{ $test->system->id }}">{{ $test->system->name }}</a></li>
    <li>{{ $test->test_type->name }} - {{ $test->test_date->format('F d, Y') }}</li>
  </ol>

<!--          LEFT SIDE CONTENT         -->

<div class="row">

  <div class="col-md-4 no-gutter-right">

    <div class="headerBar text-center">
      <h3>{{ $test->test_type->name }}</h3>
    </div>

    <div class="contentBar">

        <p><small>
        <strong>Test Date: </strong>{{ $test->test_date->format('F d, Y') }}<br>
        <strong>Technician:</strong> {{ $test->technician->first_name }} {{ $test->technician->last_name }}<br>
        <strong>Result:</strong> {{ $test->test_result->name }}
        </small></p>

    </div>

    <div class="contentBar">

        <p><small>
          <strong>Added:</strong> {{ $test->created_at->setTimezone('America/Los_Angeles')->format('F j, Y, g:i a') }}<br>
          <strong>Added By:</strong> {{ $test->addedBy->first_name }} {{ $test->addedBy->last_name }}<br>
          @if ($test->updated_by)
          <hr>
          <strong>Edited:</strong> {{ $test->updated_at->setTimezone('America/Los_Angeles')->format('F j, Y, g:i a') }}<br>
          <strong>Edited By:</strong> {{ $test->updatedBy->first_name }} {{ $test->updatedBy->last_name }}<br>
          @endif
        </small></p>

    </div>

    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateTestModal">
      <i class="fa fa-cog fa-md"></i> Edit Test</button>
    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteTestModal">
      <i class="fa fa-trash-o fa-md"></i> Delete Test</button>

  </div>

<!--          RIGHT SIDE CONTENT         -->

  <div class="col-md-8">

    <div class="buttonBar text-right">

      @if($test->test_result->name == "Pass with Deficiencies")

      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addDeficiencyModal">
        <i class="fa fa-exclamation-triangle"></i> Add Deficiency</button>

      @elseif($test->test_result->name == "Fail with Deficiencies")
      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addDeficiencyModal">
        <i class="fa fa-exclamation-triangle"></i> Add Deficiency</button>

      @endif

      @if($test->test_result->name == "Pass with Deficiencies")

      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addTestnoteModal">
        <i class="fa fa-paperclip"></i> Add Note</button>

      @elseif($test->test_result->name == "Pass with Notes")

      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addTestnoteModal">
        <i class="fa fa-paperclip"></i> Add Note</button>

      @endif

      <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addReportModal">
        <i class="fa fa-folder-open-o"></i> Add Report</button>

    </div>

    @if(count($test->reports) > 0)

    <div class="titleBar">
        <p>Reports</p>
    </div>

    <table class="table table-hover table-condensed">

      <thead>
        <tr>
          <th><small></small></th>
          <th><small></small></th>
          <th><small>Description</small></th>
          <th><small>Added By</small></th>
          <th><small></small></th>
          <th><small></small></th>
        </tr>
      </thead>

      <tbody>
        @foreach($test->reports as $report)
          <tr>
          <td><i class="fa fa-file"></i></td>
          <td><small><a href="/test/{{ $test->id }}/report/{{ $report->id }}/">{{ $report->file_name }}.{{ $report->ext }}</a></small></td>
          <td width="40%"><small>{{ $report->description }}</small></td>
          <td><small>{{ $report->addedBy->first_name }}</small></td>
          <td>

            <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#update{{ $report->id }}ReportModal">
              <i class="fa fa-cog fa-md"></i></button>

          </td>
          <td>

            <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#delete{{ $report->id }}ReportModal">
              <i class="fa fa-trash-o fa-md"></i></button>

          </td>
        </tr>

        {{-- @include('partials.modals.edit_test_report')
        @include('partials.modals.delete_test_report') --}}

        @endforeach
      </tbody>
    </table>
    @endif


    @if(count($test->deficiencies) > 0)

    <div class="titleBar">
        <p>Deficiencies</p>
    </div>

    <table class="table table-hover table-condensed">
      <thead>
        <tr>
          <th></th>
          <th><small>Description</small></th>
          <th><small>Added By</small></th>
          <th><small></small></th>
          <th><small></small></th>
        </tr>
      </thead>

      <tbody>
        @foreach($test->deficiencies as $deficiency)
          <tr>
          <td><i class="fa fa-exclamation-triangle"></i></td>
          <td width="70%"><small>{{ $deficiency->description }}</small></td>
          <td><small>{{ $deficiency->addedBy->first_name }}</small></td>
          <td>
            <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#update{{ $deficiency->id }}DeficiencyModal">
            <i class="fa fa-cog fa-md"></i></button>
          </td>
          <td>
            <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#delete{{ $deficiency->id }}DeficiencyModal">
              <i class="fa fa-trash-o fa-md"></i></button>
          </td>
        </tr>

        @include('partials.modals.edit_deficiency')
        @include('partials.modals.delete_deficiency')

        @endforeach
      </tbody>
    </table>
    @endif

    @if(count($test->testnotes) > 0)

    <div class="titleBar">
        <p>Notes</p>
    </div>

    <table class="table table-hover table-condensed">
      <thead>
        <tr>
          <th></th>
          <th><small>Note</small></th>
          <th><small>Added By</small></th>
          <th><small></small></th>
          <th><small></small></th>
        </tr>
      </thead>
      <tbody>
        @foreach($test->testnotes as $testnote)
          <tr>
          <td><i class="fa fa-paperclip"></i></td>
          <td width="70%"><small>{{ $testnote->note }}</small></td>
          <td><small>{{ $testnote->addedBy->first_name }}</small></td>
          <td>

            <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#update{{ $testnote->id }}TestnoteModal">
            <i class="fa fa-cog fa-md"></i></button>

          </td>
          <td>

            <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#delete{{ $testnote->id }}TestnoteModal">
            <i class="fa fa-trash-o fa-md"></i></button>

          </td>
        </tr>

        @include('partials.modals.edit_note')
        @include('partials.modals.delete_note')


        @endforeach
      </tbody>
    </table>
    @endif


  </div>
  </div>

    </div>
  </div>

</div>

<!--          MODAL CONTENT         -->

@include('partials.modals.add_deficiency')
@include('partials.modals.add_note')
@include('partials.modals.add_test_report')
@include('partials.modals.edit_test')
@include('partials.modals.delete_test')

@stop

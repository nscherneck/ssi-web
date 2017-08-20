@extends('layout')

@section('title', 'SSI-Extranet | Test')

@section('content')

@include('partials.nav')

<div class="container">

  @include('partials.flash')

  <!--          BREADCRUMB LINKS         -->

  <br>
  <ol class="breadcrumb small">
    <li><a href="/customers">Customers</a></li>
    <li><a href="{{ $test->system->site->customer->path() }}">{{ $test->system->site->customer->name }}</a></li>
    <li><a href="{{ $test->system->site->path() }}">{{ $test->system->site->name }}</a></li>
    <li><a href="{{ $test->system->path() }}">{{ $test->system->name }}</a></li>
    <li>{{ $test->testType->name }} - {{ $test->test_date->format('F d, Y') }}</li>
  </ol>

  <!--          MAIN CONTENT         -->

  <div class="panel panel-primary text-center">
    <div class="panel-heading"><h4>{{ $test->testType->name }}</h4></div>
  </div>


  <div class="row">

    <div class="col-lg-6">

      <div class="panel panel-primary">
        <div class="panel-body text-center">
          <p>
            <small>
            <strong>Test Date: </strong>{{ $test->test_date->format('F d, Y') }}<br>
            <strong>Technician:</strong> {{ $test->technician->first_name }} {{ $test->technician->last_name }}<br>
            </small>
          </p>
          <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateTestModal">
            <i class="fa fa-cog"></i></button>
          <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#deleteTestModal">
            <i class="fa fa-trash-o"></i></button>
        </div>
      </div>

    </div>

    <div class="col-lg-6">

      <div class="panel panel-primary">
        <div class="panel-body text-center">
          <h4>{{ $test->testResult->name }}</h4>
        </div>
      </div>

    </div>

  </div> <!--          END OF ROW         -->

  @include('tests.partials.documents_panel')

  <div class="row">

    <div class="col-lg-6">

      @if($test->testResult->name == "Pass with Deficiencies")

        @include('tests.partials.deficiency_panel')

      @elseif($test->testResult->name == "Fail with Deficiencies")

        @include('tests.partials.deficiency_panel')

      @endif

    </div> <!--          END OF 6 COLUMN         -->

    <div class="col-lg-6">

      @if($test->testResult->name == "Pass with Notes")

        @include('tests.partials.notes_panel')

      @elseif($test->testResult->name == "Pass with Deficiencies")

        @include('tests.partials.notes_panel')

      @elseif($test->testResult->name == "Fail with Deficiencies")

        @include('tests.partials.notes_panel')

      @endif

    </div> <!--          END OF 6 COLUMN         -->

  </div> <!--          END OF ROW         -->

</div> <!--          END OF CONTAINER         -->

<!--          MODAL CONTENT         -->

@include('partials.modals.add_deficiency')
@include('partials.modals.add_note')
@include('partials.modals.add_test_document')
@include('partials.modals.edit_test')
@include('partials.modals.delete_test')

@stop

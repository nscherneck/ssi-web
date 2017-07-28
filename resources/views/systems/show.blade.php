@extends('layout')

@section('title', 'SSI-Extranet | System Record')

@section('content')

@include('partials.nav')

<div class="container-fluid">

  @include('partials.flash')

  <br>
  <ol class="breadcrumb small">
    <li><a href="/customers">Customers</a></li>
    <li><a href="{{ $system->site->customer->path() }}">{{ $system->site->customer->name }}</a></li>
    <li><a href="{{ $system->site->path() }}">{{ $system->site->name }}</a></li>
    <li>{{ $system->name }}</li>
  </ol>

<!--          LEFT SIDE CONTENT         -->

<div class="row">

  <div class="col-md-3 no-gutter-right">

    <div class="panel panel-primary text-center">
      <div class="panel-heading"><h4>{{ $system->name }}</h4></div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">System Info</div>
      <div class="panel-body">
        <p>
          <small>
            <strong>System Type:</strong> {{ $system->system_type->type }}<br>
            <strong>Installation Date:</strong> {{ $system->install_date->format('F d, Y') }}<br>
            <hr>
            <strong>Installed by SSI:</strong>@if ($system->ssi_install == 1) Yes @else No @endif<br>
            <strong>Testing by SSI:</strong>@if ($system->ssi_test_acct == 1) Yes @else No @endif<br>
          </small>
        </p>
      </div>
    </div>

    @if ($system->next_test_date)
    <div class="panel panel-danger">
      <div class="panel-body text-center">
        <p>
          <strong>Next Test Due:</strong> {{ $system->next_test_date->format('F Y') }}

          <hr>

      <div class="text-center">
          <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateNextTestDateModal">
            <i class="fa fa-cog"></i></button>
          <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#nullifyNextTestDateModal">
            <i class="fa fa-trash-o"></i></button>
        </p>
      </div>

      </div>
    </div>
    @endif

    <div class="panel panel-primary">
      <div class="panel-body">
        <p>
          <small>
            <strong>Added:</strong> {{ $system->formatted_created_at }}<br>
            <strong>Added By:</strong> {{ $system->addedBy->full_name }}<br>
            @if ($system->updated_by)
            <hr>
            <strong>Edited:</strong> {{ $system->formatted_updated_at }}<br>
            <strong>Edited By:</strong> {{ $system->updatedBy->full_name }}<br>
            @endif
          </small>
        </p>
      </div>
    </div>

    @if ($system->notes)
    <div class="panel panel-primary">
    <div class="panel-heading">Notes</div>
    <div class="panel-body">
      <small>
      {!! nl2br(e($system->notes)) !!}
      </small>
    </div>
    </div>
    @endif

    <div class="text-center">

      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateSystemModal">
        <i class="fa fa-cog"></i></button>
      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#deleteSystemModal">
        <i class="fa fa-trash-o"></i></button>
      <br><br>

    </div>

  </div>

<!--          RIGHT SIDE CONTENT         -->

<div class="col-md-9">

  <div class="titleBar" style="margin-top: 0">
    <p>Components ({{ $system->sumComponents() }})</p>
  </div>

    <h5>Detection &amp; Controls</h5>
    @include('systems.partials.components_tables.detection_and_controls_table')

      @if ($system->getComponent(5)->count() > 0)
        <h5>Renewable Components</h5>
        @include('systems.partials.components_tables.renewable_components_table')
      @endif

      @if ($system->getComponent(7)->count() > 0)
        <h5>Agent Tanks</h5>
        @include('systems.partials.components_tables.agent_tanks_table')
      @endif

  <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#attachComponentModal">
  <i class="fa fa-plus" aria-hidden="true"></i>
  </button>
  <hr>

  <div class="row">

    <div class="col-lg-6 no-gutter-right">

      <div class="panel panel-info">
        <div class="panel-heading">Tests &amp; Inspections ({{ $system->tests()->count() }})</div>

          <table class="table table-condensed">
            <thead>
              <tr>
                <th><small>Test Date</small></th>
                <th><small>Technician</small></th>
                <th><small>Type</small></th>
                <th><small>Result</small></th>
                <th><small>Added By</small></th>
              </tr>
            </thead>
            <tbody>
              @foreach($system->tests as $test)
                <tr>
                <td><small><a href="{{ $test->path() }}">{{ $test->test_date->format('F d, Y') }}</a></small></td>
                <td><small>{{ $test->technician->first_name }} {{ $test->technician->last_name }}</small></td>
                <td><small>{{ $test->test_type->name }}</small></td>
                <td><small>{{ $test->test_result->name }}</small></td>
                <td><small>{{ $test->addedBy->first_name }} {{ $test->addedBy->last_name }}</small></td>
              </tr>
              @endforeach
            </tbody>
          </table>

        <div class="panel-footer text-left">

          <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addTestModal">
            <i class="fa fa-plus" aria-hidden="true"></i>
          </button>

        </div>

      </div> <!-- END OF PANEL -->

    </div> <!-- END OF COL-6 -->

    <div class="col-lg-6">

      <div class="panel panel-info">
      <div class="panel-heading">System Documents</div>

        <table class="table table-condensed">
          <thead>
            <tr>
              <th><small>Name</small></th>
              <th><small>-</small></th>
              <th><small>-</small></th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>

      <div class="panel-body"></div>

      <div class="panel-footer text-left">

        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addSystemDocumentModal">
          <i class="fa fa-plus" aria-hidden="true"></i>
        </button>

      </div>

      </div> <!-- END OF PANEL -->

    </div> <!-- END OF COL-6 -->

  </div> <!-- END OF ROW -->

  <!-- PHOTOS PANEL -->

      <div class="panel panel-info">
        <div class="panel-heading">System Photos ({{ count($system->photos) }})</div>
        <div class="panel-body text-center">
          
          @if ($photos->count() > 0)

            @foreach ($photos as $photo)
              <div id="system-photo">
                <a href="/system/photo/{{ $photo->id }}/">
                  <img src="{{ env('SYSTEM_PHOTO_THUMB_URL') }}{{ $photo->file_name }}.{{ $photo->ext }}">
                </a>
                <br>
                <p>
                  <small>
                    {{ $photo->caption }}
                    <br>
                    {{ $photo->getFilesize() }}
                  </small>
                </p>
              </div>

            @endforeach

          @endif

        </div>

        <div class="panel-footer text-left">

          <button 
            type="button" 
            class="btn btn-default btn-xs" 
            data-toggle="modal" 
            data-target="#addSystemPhotoModal"
          >
            <i class="fa fa-plus" aria-hidden="true"></i>
          </button>

        </div>

      </div> <!-- END OF PANEL -->

      <div class="row">

        <div class="col-lg-6 no-gutter-right">

          <div class="panel panel-info">
          <div class="panel-heading">System Comments</div>

            <table class="table table-condensed">
              <thead>
                <tr>
                  <th><small>Comment</small></th>
                  <th><small>By</small></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>

          <div class="panel-body"></div>

          <div class="panel-footer text-left">

            <button 
              type="button" class="btn btn-default btn-xs" 
              data-toggle="modal" 
              data-target="#addSystemCommentModal"
            >
              <i class="fa fa-plus" aria-hidden="true"></i>
            </button>

          </div>

          </div> <!-- END OF PANEL -->

        </div> <!-- END OF COL-6 -->

    </div> <!-- END OF ROW -->

</div> <!-- END OF COL-9 -->



  </div> <!-- END OF MAIN ROW -->
</div> <!-- END OF CONTAINER -->

@if ($system->next_test_date)
  @include('partials.modals.edit_next_test_date')
  @include('partials.modals.nullify_next_test_date')
@endif

@include('partials.modals.edit_system')
@include('partials.modals.delete_system')
@include('partials.modals.attach_component')
@include('partials.modals.add_test')
@include('partials.modals.add_system_photo')

@stop

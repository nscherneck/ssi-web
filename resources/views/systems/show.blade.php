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
      <div class="panel-heading page-heading">
        @include('partials.icons.system-icon')
        <h4>{{ $system->name }}</h4>
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">
        @include('partials.icons.info-icon') System Info
      </div>
      <div class="panel-body">
        <p>
          <small>
            <strong>System Type:</strong> {{ $system->systemType->type }}<br>
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
        @can('Edit System')
          <button type="button"
            class="btn btn-default btn-xs"
            data-toggle="modal"
            data-target="#updateNextTestDateModal">
            @include('partials.icons.edit-icon')
          </button>
          <button type="button"
            class="btn btn-default btn-xs"
            data-toggle="modal"
            data-target="#nullifyNextTestDateModal">
            @include('partials.icons.delete-icon')
          </button>
        @endcan
        @cannot('Edit System')
          <button type="button"
            class="btn btn-default btn-xs"
            disabled>
            @include('partials.icons.edit-icon')
          </button>
          <button type="button"
            class="btn btn-default btn-xs"
            disabled>
            @include('partials.icons.delete-icon')
          </button>
        @endcannot

        </p>
      </div>

      </div>
    </div>
    @endif

    @include('partials.meta_panel', ['color' => 'primary', 'model' => 'system'])

    @include('partials.notes_panel', ['color' => 'primary', 'model' => 'system'])

    <div class="text-center">
      @can('Edit System')
        <button type="button"
          class="btn btn-default btn-xs"
          data-toggle="modal"
          data-target="#updateSystemModal">
          @include('partials.icons.edit-icon')
        </button>
      @endcan
      @cannot('Edit System')
        <button type="button"
          class="btn btn-default btn-xs"
          disabled>
          @include('partials.icons.edit-icon')
        </button>
      @endcannot
      @can('Delete System')
        <button type="button"
          class="btn btn-default btn-xs"
          data-toggle="modal"
          data-target="#deleteSystemModal">
          @include('partials.icons.delete-icon')
        </button>
      @endcan
      @cannot('Delete System')
        <button type="button"
          class="btn btn-default btn-xs"
          disabled>
          @include('partials.icons.delete-icon')
        </button>
      @endcannot
      <br><br>

    </div>

  </div>

<!--          RIGHT SIDE CONTENT         -->

<div class="col-md-9">

  <div class="titleBar" style="margin-top: 0">
    <p>Components ({{ $system->components->sum('pivot.quantity') }})</p>
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

  @can('Attach Component')
    <button type="button"
      class="btn btn-default btn-xs"
      data-toggle="modal"
      data-target="#attachComponentModal">
      @include('partials.icons.add-icon')
    </button>
  @endcan
  @cannot('Attach Component')
    <button type="button"
      class="btn btn-default btn-xs"
      disabled>
      @include('partials.icons.add-icon')
    </button>
  @endcannot

  <hr>

  <div id="tests" class="panel panel-info">
    <div class="panel-heading">
      @include('partials.icons.test-icon') Tests &amp; Inspections ({{ $system->tests()->count() }})
    </div>

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
            <td><small>{{ $test->testType->name }}</small></td>
            <td><small>{{ $test->testResult->name }}</small></td>
            <td><small>{{ $test->addedBy->first_name }} {{ $test->addedBy->last_name }}</small></td>
          </tr>
          @endforeach
        </tbody>
      </table>

    <div class="panel-footer text-left">

      @can('Create Test')
        <button type="button"
          class="btn btn-default btn-xs"
          data-toggle="modal"
          data-target="#addTestModal">
          @include('partials.icons.add-icon')
        </button>
      @endcan
      @cannot('Create Test')
        <button type="button"
          class="btn btn-default btn-xs"
          disabled>
          @include('partials.icons.add-icon')
        </button>
      @endcannot

    </div>

  </div> <!-- END OF PANEL -->

  @include('systems.partials.documents_panel')

  <!-- PHOTOS PANEL -->

      <div id="photos" class="panel panel-info">
        <div class="panel-heading">
          @include('partials.icons.photo-icon') System Photos ({{ count($system->photos) }})
        </div>
        <div class="panel-body text-center">

          @if ($photos->count() > 0)

            @foreach ($photos as $photo)
              <div id="system-photo">
                <a href="{{ $photo->pathToSystemPhoto() }}">
                  <img src="{{ config('constants.PHOTO.thumbnail-url') }}{{ $photo->file_name }}.{{ $photo->ext }}">
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

          @can('Create System Photo')
            <button
              type="button"
              class="btn btn-default btn-xs"
              data-toggle="modal"
              data-target="#addSystemPhotoModal">
              @include('partials.icons.add-icon')
            </button>
          @endcan
          @cannot('Create System Photo')
            <button
              type="button"
              class="btn btn-default btn-xs"
              disabled>
              @include('partials.icons.add-icon')
            </button>
          @endcannot

        </div>

      </div> <!-- END OF PANEL -->

</div> <!-- END OF COL-9 -->



  </div> <!-- END OF MAIN ROW -->
</div> <!-- END OF CONTAINER -->

@if ($system->next_test_date)
  @can('Edit System')
    @include('partials.modals.edit_next_test_date')
    @include('partials.modals.nullify_next_test_date')
  @endcan
@endif

@can('Edit System')
  @include('partials.modals.edit_system')
@endcan
@can('Delete System')
  @include('partials.modals.delete_system')
@endcan
@can('Attach Component')
  @include('partials.modals.attach_component')
@endcan
@can('Create Test')
  @include('partials.modals.add_test')
@endcan
@can('Create System Photo')
  @include('partials.modals.add_system_photo')
@endcan
@can('Create System Document')
  @include('partials.modals.add_system_document')
@endcan

@endsection

@extends('layout')

@section('title', 'SSI-Extranet | Site Record')

@section('content')

@include('partials.nav')

<div class="container-fluid">

  @include('partials.flash')

  <br>
  <ol class="breadcrumb small">
    <li><a href="/customers">Customers</a></li>
    <li><a href="{{ $site->customer->path() }}">{{ $site->customer->name }}</a></li>
    <li>{{ $site->name }}</li>
  </ol>

<!--          LEFT SIDE CONTENT         -->

  <div class="row">

    <div class="col-md-3 no-gutter-right">

      <div class="panel panel-primary text-center">
        <div class="panel-heading page-heading">
          @include('partials.icons.site-icon')
          <h4>{{ $site->name }}</h4>
        </div>
      </div>

      <div class="panel panel-primary">
        <div class="panel-heading">
          @include('partials.icons.info-icon') Site Info
        </div>
        <div class="panel-body">
          <p>
            <small>
              {{ $site->address1 }}<br>
              @if ($site->address2)
              {{ $site->address2 }}<br>
              @endif
              @if ($site->address3)
              {{ $site->address3 }}<br>
              @endif

              {{ $site->city }}, {{ $site->state->state }}  {{ $site->zip}}
              <hr>
              <strong>Servicing Office:</strong> {{ $site->branchOffice->name }}
            </small>
          </p>
        </div>
      </div>

      <div class="panel panel-primary">
        <div class="panel-heading">
          @include('partials.icons.travel-icon') Travel Info
        </div>

          <table class="table table-condensed">
            <thead>
              <tr>
                <th><small>Branch Office</small></th>
                <th><small>Distance</small></th>
                <th><small>Travel Time</small></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($branchOffices as $branchOffice)
                <tr>
                  <td><small>{{ $branchOffice->name }}</small></td>
                  <td>
                    <small>
                      {{ $site->travelCalculator($branchOffice->latitude, $branchOffice->longitude, 'distance') }} miles
                    </small>
                  </td>
                  <td>
                    <small>
                      {{ $site->travelCalculator($branchOffice->latitude, $branchOffice->longitude, 'duration') }}
                    </small>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        <div class="panel-footer">
          <small>
            @component('sites.partials.google-map-link')
              @slot('latitude')
                {{ $site->lat }}
              @endslot
              @slot('longitude')
                {{ $site->lon }}
              @endslot
            @endcomponent
          </small>
        </div>
      </div> <!-- END OF PANEL -->

      <div class="panel panel-primary">
        <div class="panel-body">
          <p><small>
            <strong>Added:</strong> {{ $site->formatted_created_at }}<br>
            <strong>Added By:</strong> {{ $site->addedBy->full_name }}<br>
            @if($site->updated_by)
            <hr>
            <strong>Edited:</strong> {{ $site->formatted_updated_at }}<br>
            <strong>Edited By:</strong> {{ $site->updatedBy->full_name }}<br>
            @endif
          </small></p>
        </div>
      </div>

      @if ($site->notes)
      <div class="panel panel-primary">
      <div class="panel-heading">
        @include('partials.icons.notes-icon') Notes
      </div>
      <div class="panel-body">
        <small>
        {!! nl2br(e($site->notes)) !!}
        </small>
      </div>
      </div>
      @endif

      <div class="text-center">
        @can('update', $site)
          <button type="button"
            class="btn btn-default btn-xs"
            data-toggle="modal"
            data-target="#updateSiteModal">
            @include('partials.icons.edit-icon')
          </button>
        @elsecan('view', $site)
          <button type="button"
            class="btn btn-default btn-xs"
            disabled>
            @include('partials.icons.edit-icon')
          </button>
        @endcan
        @can('delete', $site)
          <button type="button"
            class="btn btn-default btn-xs"
            data-toggle="modal"
            data-target="#deleteSiteModal">
            @include('partials.icons.delete-icon')
          </button>
        @elsecan('view', $site)
          <button type="button"
            class="btn btn-default btn-xs"
            disabled>
            @include('partials.icons.delete-icon')
          </button>
        @endcan
        <br><br>
      </div>


    </div>

  <!--          RIGHT SIDE CONTENT         -->

    <div class="col-md-9">

    <script> var myLatLng = {lat: {{ $site->lat }}, lng: {{ $site->lon }}}; </script>

    @include('partials.sites_map')

    <br>

    <div class="panel panel-info">
      <div class="panel-heading">
        @include('partials.icons.system-icon') Systems ({{ $site->systems()->count() }})
      </div>

        <table class="table table-condensed">
          <thead>
            <tr>
              <th><small>Name</small></th>
              <th><small>Type</small></th>
              <th><small>Components</small></th>
              <th><small>Last Test</small></th>
            </tr>
          </thead>
          <tbody>
            @foreach($site->systems as $system)
            <tr>
              <td><small><a href="{{ $system->path() }}">{{ $system->name }}</a></small></td>
              <td><small>{{ $system->systemType->type }}</small></td>
              <td><small>{{ $system->components->sum('pivot.quantity') }}</small></td>
              <td><small>{{ $system->getMostRecentTest() }}</small></td>
            </tr>
            @endforeach
          </tbody>
        </table>

      <div class="panel-footer">

        <button type="button"
          class="btn btn-default btn-xs"
          data-toggle="modal"
          data-target="#addSystemModal">
          @include('partials.icons.add-icon')
        </button>

      </div>

    </div> <!-- END OF PANEL -->

    <div class="panel panel-info">
    <div class="panel-heading">Jobs (0)</div>

      <table class="table table-condensed">
        <thead>
          <tr>
            <th><small>Job #</small></th>
            <th><small>Name</small></th>
            <th><small>Scope of Work</small></th>
            <th><small>Stage</small></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

    <div class="panel-body"></div>

    </div> <!-- END OF PANEL -->

    </div> <!-- END OF COL-9 -->

  </div> <!-- END OF ROW -->

</div> <!-- END OF CONTAINER -->

@include('partials.modals.edit_site')
@include('partials.modals.delete_site')
@include('partials.modals.add_system')

@stop

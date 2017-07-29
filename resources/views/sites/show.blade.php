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
        <div class="panel-heading"><h4>{{ $site->name }}</h4></div>
      </div>

      <div class="panel panel-primary">
        <div class="panel-heading">Site Info</div>
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
              {!! $site->getGoogleMapsHyperlink('Google Map') !!}
            </small>
          </p>
        </div>
      </div>

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
      <div class="panel-heading">Notes</div>
      <div class="panel-body">   
        <small>
        {!! nl2br(e($site->notes)) !!}
        </small>
      </div>
      </div>
      @endif

      <div class="text-center">
        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateSiteModal">
          <i class="fa fa-cog"></i></button>
        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#deleteSiteModal">
          <i class="fa fa-trash-o"></i></button>
        <br><br>
      </div>


    </div>

  <!--          RIGHT SIDE CONTENT         -->

    <div class="col-md-9">

    <script> var myLatLng = {lat: {{ $site->lat }}, lng: {{ $site->lon }}}; </script>

    @include('partials.sites_map')

    <br>

    <div class="row">

      <div class="col-lg-6 text-center">

        @php
        $travel_data = $site->getTravelData($site->lat, $site->lon);
        echo "<small><p>Travel from<strong> Fife Office: </strong>" . $travel_data[2] . " <strong>(" . $travel_data[3] . ")</strong></p></small>";
        @endphp
        <br>

      </div>

      <div class="col-lg-6 text-center">

        @php
        $travel_data = $site->getTravelData($site->lat, $site->lon);
        echo "<small><p>Travel from<strong> Portland Office: </strong>" . $travel_data[0] . " <strong>(" . $travel_data[1] . ")</strong></p></small>";
        @endphp
        <br>

      </div>

    </div>


    <div class="row">

      <div class="col-lg-6 no-gutter-right">

        <div class="panel panel-info">
          <div class="panel-heading">Systems ({{ $site->systems()->count() }})</div>

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
                  <td><small>{{ $system->system_type->type }}</small></td>
                  <td><small>{{ $system->sumComponents() }}</small></td>
                  <td><small>{{ $system->getMostRecentTest() }}</small></td>
                </tr>
                @endforeach
              </tbody>
            </table>

          <div class="panel-footer">

            <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addSystemModal"><i class="fa fa-plus" aria-hidden="true"></i></button>

          </div>

        </div> <!-- END OF PANEL -->

      </div> <!-- END OF COL-6 -->

      <div class="col-lg-6">

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

      </div> <!-- END OF COL-6 -->

    </div> <!-- END OF ROW -->

    <!-- PHOTOS PANEL -->

        <div class="panel panel-info">
          <div class="panel-heading">Site Photos (0)</div>
          <div class="panel-body">
          </div>

          <div class="panel-footer">
            <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addSitePhotoModal"><i class="fa fa-plus" aria-hidden="true"></i></button>
          </div>

        </div> <!-- END OF PANEL -->

        <div class="row">

          <div class="col-lg-6 no-gutter-right">

            <div class="panel panel-info">
            <div class="panel-heading">Site Documents (0)</div>

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

              <div class="panel-footer">
                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addSiteDocumentModal"><i class="fa fa-plus" aria-hidden="true"></i></button>
              </div>

            </div> <!-- END OF PANEL -->

          </div> <!-- END OF COL-6 -->

          <div class="col-lg-6">

            <div class="panel panel-info">
            <div class="panel-heading">Site Comments (0)</div>

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

              <div class="panel-footer">
                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addSiteCommentModal"><i class="fa fa-plus" aria-hidden="true"></i></button>
              </div>

            </div> <!-- END OF PANEL -->

          </div> <!-- END OF COL-6 -->

      </div> <!-- END OF ROW -->

    </div> <!-- END OF COL-9 -->

  </div> <!-- END OF ROW -->

</div> <!-- END OF CONTAINER -->

@include('partials.modals.edit_site')
@include('partials.modals.delete_site')
@include('partials.modals.add_system')

@stop

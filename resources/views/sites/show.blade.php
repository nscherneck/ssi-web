@extends('layout')

@section('title', 'SSI-Web | Site Record')

@section('content')

@include('partials.nav')

@include('partials.flash')

<div class="container-fluid">

  <br>
  <ol class="breadcrumb small">
    <li><a href="/customers">Customers</a></li>
    <li><a href="/customer/{{ $site->customer->id }}">{{ $site->customer->name }}</a></li>
    <li>{{ $site->name }}</li>
  </ol>


<!--          LEFT SIDE CONTENT         -->

<div class="row">

  <div class="col-md-4">

    <h3>{{ $site->name }}</h3>
    <br>

    <p>
      {{ $site->address1 }}  {{ $site->address2 }}<br>
      {{ $site->city }}, {{ $site->state->state }}  {{ $site->zip}}<br><br>
      <small>Created: {{ $site->created_at->setTimezone('America/Los_Angeles')->format('F j, Y, g:i a') }}<br></small>
      <small>Modified: {{ $site->updated_at->setTimezone('America/Los_Angeles')->format('F j, Y, g:i a') }}</small>
    </p>

    <hr>

    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateSiteModal">Edit Site</button>
    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteSiteModal">Delete Site</button>

    <hr>

    <h5><strong>Notes:</strong></h5>
    <p>
      {{ $site->notes }}
    </p>

  </div>

<!--          RIGHT SIDE CONTENT         -->

  <div class="col-md-8">
    <br>

    <style>
      button.accordion {
          background-color: #eee;
          color: #444;
          cursor: pointer;
          padding: 6px;
          width: 100%;
          border:1px solid gray;
          border-radius: 5px;
          text-align: center;
          outline: none;
          font-size: 10px;
          transition: 0.4s;
      }

      button.accordion.active, button.accordion:hover {
          background-color: #999;
          color: #fff;

      }

      div.panel {
          padding: 8px 4px;
          display: none;
          background-color: white;
      }

      div.panel.show {
          display: block;
      }
  </style>

  <script> var myLatLng = {lat: {{ $site->lat }}, lng: {{ $site->lon }}}; </script>

  @include('partials.map')
  <br>

  <?php
  $travel_data = $site->get_travel_data($site->lat, $site->lon);
  echo "<small><p>Distance from<strong> Fife Office: </strong>" . $travel_data[2] . " <strong>(" . $travel_data[3] . ")</strong></p></small>";
  echo "<small><p>Distance from<strong> Portland Office: </strong>" . $travel_data[0] . " <strong>(" . $travel_data[1] . ")</strong></p></small>";
  ?>

    <button class="accordion">Jobs</button>
    <div class="panel">
      <p>No jobs.</p>
    </div>

    <button class="accordion">Systems</button>
    <div class="panel">

      <table class="table table-striped table-condensed">
        <thead>
          <tr>
            <th><small>System Name</small></th>
            <th><small>Type</small></th>
            <th><small>Components</small></th>
            <th><small>Last Test</small></th>
            <th><small>SSI Install</small></th>
            <th><small>SSI Test Acct</small></th>
          </tr>
        </thead>
        <tbody>
          @foreach($site->systems as $system)
          <tr>
            <td><small><a href="/system/{{ $system->id }}">{{ $system->name }}</a></small></td>
            <td><small>{{ $system->system_type->type }}</small></td>
            <td><small>{{ $system->count_components() }}</small></td>
            <td><small>{{ $system->get_latest_test() }}</small></td>
            <td><small>@if ($system->ssi_install === 1) Yes @else No @endif</small></td>
            <td><small>@if ($system->ssi_test_acct === 1) Yes @else No @endif</small></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <br>

      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addSystemModal">Add System</button>

    </div>

    <button class="accordion">Documents</button>
    <div class="panel">
      <p>No documents.</p>
    </div>

    <button class="accordion">Photos</button>
    <div class="panel">
      <p>No photos.</p>

      <hr>

      <a href="/site/{{ $site->id }}/photo/create"><small>Add a Photo</small></a>

    </div>

    <button class="accordion">Comments</button>
    <div class="panel">
      <p>No comments.</p>
    </div>

    <script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function(){
            this.classList.toggle("active");
            this.nextElementSibling.classList.toggle("show");
      }
    }
    </script>
  </div>
  </div>
</div>

@include('partials.modals.edit_site')
@include('partials.modals.delete_site')
@include('partials.modals.add_system')

@stop

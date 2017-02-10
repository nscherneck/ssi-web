@extends('layout')

@section('title', 'SSI-Extranet | Sites Index')

@section('content')

  <div class="container-fluid">

    @include('partials.nav')

    <div class="btn-group btn-group-sm" role="group" aria-label="..." style="margin: 10px 0; text-decoration: none;">
      <a href="/customers" style="text-decoration: none;" type="button" class="btn btn-default">Customers Index</a>
      <a href="/sites" style="text-decoration: none;" type="button" class="btn btn-default">Sites Index</a>
    </div>

    <div class="panel panel-info">
      <div class="panel-heading"><i class="fa fa-map-marker" aria-hidden="true"></i> All Sites ({{ $sites->count() }})</div>
      <div class="panel-body" style="padding: 10px;">

        @include('partials.sites_index_map')

      </div>
    </div>


    <div class="titleBar" style="margin-top: 0;">
        <p>Sites Index</p>
    </div>

    <div class="table-responsive">

      <table class="table table-hover table-condensed">

        <thead>
          <tr>
            <th><small>Created</small></th>
            <th><small>Customer</small></th>
            <th><small>Site</small></th>
            <th><small>Address</small></th>
            <th><small>City</small></th>
            <th><small>State</small></th>
            <th><small>Zip</small></th>
            <th><small>Systems</small></th>
          </tr>
        </thead>

        <tbody>
          @foreach($sites as $site)
            <tr>
            <td><small>{{ $site->created_at->setTimezone('America/Los_Angeles')->format('D, F j') }}</small></td>
            <td><small><a href="/customer/{{ $site->customer_id }}">{{ $site->customer->name }}</a></small></td>
            <td><small><a href="/site/{{ $site->id }}">{{ $site->name }}</a></small></td>
            <td><small>{{ $site->address1 }}</small></td>
            <td><small>{{ $site->city }}</small></td>
            <td><small>{{ $site->state->abbreviated }}</small></td>
            <td><small>{{ $site->zip }}</small></td>
            <td><small>{{ count($site->systems) }}</small></td>
          </tr>
          @endforeach
        </tbody>

      </table>

    </div> <!-- END OF RESPONSIVE TABLE DIV -->

  </div> <!-- END OF CONTAINER DIV -->

@stop

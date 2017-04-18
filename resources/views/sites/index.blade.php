@extends('layout')

@section('title', 'SSI-Extranet | Sites Index')

@section('content')

  <div class="container-fluid" style="margin-top: 15px">

    @include('partials.nav')

    <div class="panel panel-info">
      <div class="panel-heading"><i class="fa fa-map-marker" aria-hidden="true"></i> All Sites ({{ $sites->count() }})</div>
      <div class="panel-body" style="padding: 10px;">

        @include('partials.sites_index_map')

      </div>
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

            <td><small>
            {{ $site->formatted_for_index_created_at }}
            </small></td>

            <td><small>
            <a href="/customer/{{ $site->customer_id }}">{{ $site->customer->name }}</a>
            </small></td>

            <td><small>
            <a href="/site/{{ $site->id }}">{{ $site->name }}</a>
            </small></td>

            <td><small>
            {{ $site->address1 }}
            </small></td>

            <td><small>
            {{ $site->city }}
            </small></td>

            <td><small>
            {{ $site->state->abbreviated }}
            </small></td>

            <td><small>
            {{ $site->zip }}
            </small></td>

            <td><small>
            {{ count($site->systems) }}
            </small></td>

          </tr>
          @endforeach
        </tbody>

      </table>

    </div> <!-- END OF RESPONSIVE TABLE DIV -->

  </div> <!-- END OF CONTAINER DIV -->

@stop

@extends('layout')

@section('title', 'SSI-Extranet | Sites Lookup')

@section('content')

  <div class="container" style="margin-top: 15px">

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

              <td>
                <small>
                  <a href="{{ $site->customer->path() }}">
                    {{ $site->customer->name }}
                  </a>
                </small>
              </td>

              <td>
                <small>
                  <a href="{{ $site->path() }}">
                    {{ $site->name }}
                  </a>
                </small>
              </td>

              <td>
                <small>
                  {{ $site->address1 }}
                </small>
              </td>

              <td>
                <small>
                  {{ $site->city }}
                </small>
              </td>

              <td>
                <small>
                  {{ $site->state->abbreviated }}
                </small>
              </td>

              <td>
                <small>
                  {{ $site->zip }}
                </small>
              </td>

              <td class="text-center">
                <small>
                  {{ $site->systems_count }}
                </small>
              </td>

          </tr>
          @endforeach
        </tbody>

      </table>

    </div> <!-- END OF RESPONSIVE TABLE DIV -->

  </div> <!-- END OF CONTAINER DIV -->

@stop

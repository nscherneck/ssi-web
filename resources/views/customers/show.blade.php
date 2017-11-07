@extends('layout')

@section('title', 'SSI-Extranet | Customer Record')

@section('head')
@stop

@section('content')

@include('partials.nav')

<div class="container-fluid">

  @include('partials.flash')

  <br>

  <ol class="breadcrumb small">
    <li><a href="/customers">Customers</a></li>
    <li>{{ $customer->name }}</li>
  </ol>

<!--          LEFT SIDE CONTENT         -->

<div class="row">

  <div class="col-lg-3 no-gutter-right">

    <div class="panel panel-primary text-center">
      <div class="panel-heading page-heading">
        @include('partials.icons.customer-icon')
        <h4>{{ $customer->name }}</h4>
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">
        @include('partials.icons.info-icon') Customer Info
      </div>
      <div class="panel-body">
        <p>
          <small>
            {{ $customer->address1 }}<br>
            @if ($customer->address2)
              {{ $customer->address2 }}<br>
            @endif
            @if ($customer->address3)
              {{ $customer->address3 }}<br>
            @endif
            {{ $customer->city }}, {{ $customer->state->state }}  {{ $customer->zip }}<br>
            <a href="{{ $customer->web }}" target="blank">{{ $customer->web }}</a>
          </small>
        </p>
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-body">
        <p>
          <small>
            <strong>Added:</strong> {{ $customer->formatted_created_at }}<br>
            <strong>Added By:</strong> {{ $customer->addedBy->full_name }}<br>
            @if ($customer->updated_by)
            <hr>
            <strong>Edited:</strong> {{ $customer->formatted_updated_at }}<br>
            <strong>Edited By:</strong> {{ $customer->updatedBy->full_name }}<br>
            @endif
          </small>
        </p>
      </div>
    </div>

    @if ($customer->notes)
    <div class="panel panel-primary">
    <div class="panel-heading">
      @include('partials.icons.notes-icon') Notes
    </div>
    <div class="panel-body">
      <small>
      {!! nl2br(e($customer->notes)) !!}
      </small>
    </div>
    </div>
    @endif

  <div class="text-center">
    @can('Edit Customer')
      <button type="button"
        class="btn btn-default btn-xs"
        data-toggle="modal"
        data-target="#updateCustomerModal">
        @include('partials.icons.edit-icon')
      </button>
    @endcan
    @cannot('Edit Customer')
      <button type="button"
        class="btn btn-default btn-xs"
        disabled>
        @include('partials.icons.edit-icon')
      </button>
    @endcannot

    @can('Delete Customer')
      <button type="button"
        class="btn btn-default btn-xs"
        data-toggle="modal"
        data-target="#deleteCustomerModal">
        @include('partials.icons.delete-icon')
      </button>
    @endcan
    @cannot('Delete Customer')
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

  <div class="col-lg-9">

    @include('partials.customers_map')

    <div class="panel panel-info"> <!-- START SITES PANEL -->
      <div class="panel-heading">
        @include('partials.icons.site-icon') Sites ({{ $customer->sites_count }})
      </div>
        <table class="table table-condensed">
          <thead>
            <tr>
              <th><small>Site Name</small></th>
              <th><small>Address</small></th>
              <th><small>City</small></th>
              <th><small>State</small></th>
              <th><small>Map</small></th>
            </tr>
          </thead>
          <tbody>
            @foreach($customer->sites as $site)
              <tr>

              <td><small>
              <a href="{{ $site->path() }}/">
              {{ $site->name }}
              </a>
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

              <td>
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
              </td>

            </tr>
            @endforeach
          </tbody>
        </table>

        <div class="panel-footer">
          @can('Create Site')
            <button type="button"
              class="btn btn-default btn-xs"
              data-toggle="modal"
              data-target="#addSiteModal">
              @include('partials.icons.add-icon')
            </button>
          @endcan
          @cannot('Create Site')
            <button type="button"
              class="btn btn-default btn-xs"
              disabled>
              @include('partials.icons.add-icon')
            </button>
          @endcannot
          <br>

        </div>

    </div> <!-- END SITES PANEL -->

  </div> <!-- END COL-9 -->

  </div> <!-- END ROW -->

  </div> <!-- END CONTAINER -->

  @can('Edit Customer', $customer)
    @include('partials.modals.edit_customer')
  @endcan
  @can('Delete Customer', $customer)
    @include('partials.modals.delete_customer')
  @endcan
  @can('Create Site')
    @include('partials.modals.add_site')
  @endcan

@endsection

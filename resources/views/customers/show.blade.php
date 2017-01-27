@extends('layout')

@section('title', 'SSI-Extranet | Customer Record')

@section('head')

<!-- <script src="{{ URL::asset('css/customers_map.css') }}"></script> -->

@stop

@section('content')

@include('partials.nav')

@include('partials.flash')

<div class="container-fluid">

  <br>
  <ol class="breadcrumb small">
    <li><a href="/customers">Customers</a></li>
    <li>{{ $customer->name }}</li>
  </ol>

<!--          LEFT SIDE CONTENT         -->

<div class="row">

  <div class="col-lg-3 no-gutter-right">

    <div class="panel panel-primary text-center">
      <div class="panel-heading"><h4>{{ $customer->name }}</h4></div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">Customer Info</div>
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
            {{ $customer->city }}, {{ $customer->state->state }}  {{ $customer->zip}}<br>
            <a href="http://{{ $customer->web }}" target="blank">{{ $customer->web }}</a>
          </small>
        </p>
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-body">
        <p>
          <small>
            <strong>Added:</strong> {{ $customer->created_at->setTimezone('America/Los_Angeles')->format('F j, Y, g:i a') }}<br>
            <strong>Added By:</strong> {{ $customer->addedBy->first_name }} {{ $customer->addedBy->last_name }}<br>
            @if($customer->updated_by)
            <hr>
            <strong>Edited:</strong> {{ $customer->updated_at->setTimezone('America/Los_Angeles')->format('F j, Y, g:i a') }}<br>
            <strong>Edited By:</strong> {{ $customer->updatedBy->first_name }} {{ $customer->updatedBy->last_name }}<br>
            @endif
          </small>
        </p>
      </div>
    </div>

    @if ($customer->notes)
    <div class="panel panel-primary">
      <div class="panel-body">
        <p>
            <p><small>
              <strong>Notes: </strong>
            </small></p>

            <p><small>
              {{ $customer->notes }}
            </small></p>
        </p>
      </div>
    </div>
    @endif

  <div class="text-center">
    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateCustomerModal">
      <i class="fa fa-cog"></i></button>
    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#deleteCustomerModal">
      <i class="fa fa-trash"></i></button>
    <br><br>
  </div>

  </div>

<!--          RIGHT SIDE CONTENT         -->

  <div class="col-lg-9">

    <div class="row">

      <div class="col-lg-12">

        @include('partials.customers_map')

      </div>

      </div>

    <div class="row">

      <div class="col-lg-8 no-gutter-right">

        <div class="panel panel-info">
          <div class="panel-heading">Sites ({{ $customer->sites->count() }})</div>
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
                  <td><small><a href="/site/{{ $site->id }}/">{{ $site->name }}</a></small></td>
                  <td><small>{{ $site->address1 }}</small></td>
                  <td><small>{{ $site->city }}</small></td>
                  <td><small>{{ $site->state->abbreviated }}</small></td>
                  <td><small><a href="https://www.google.com/maps/place//@<?= $site->lat ?>,{{ $site->lon }},18z" target="blank">Map</a></small></td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <div class="panel-footer">

              <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addSiteModal">
                <i class="fa fa-plus"></i></button>
              <br>

            </div>

        </div>

      </div>

      <div class="col-lg-4">

        <div class="panel panel-info">
          <div class="panel-heading">Documents (0)</div>
            <table class="table table-condensed">
              <thead>
                <tr>
                  <th><small>File</small></th>
                  <th><small></small></th>
                  <th><small></small></th>
                </tr>
              </thead>
              <tbody>
{{--               @foreach($documents as $document)
                <tr>
                <td width="90%"><small>
                  <a href="https://s3-us-west-2.amazonaws.com/ssiwebstorage/{{ $document->path }}/{{ $document->file_name }}.{{ $document->ext }}" target="blank">
                  {{ $document->file_name }}.{{ $document->ext }}
                  </a>
                </small>
                </td>
                <td width="5%">
                  <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#">
                    <i class="fa fa-cog"></i></button>
                </td>
                <td width="5%">
                  <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#deleteSystemModal">
                    <i class="fa fa-trash"></i></button>
                </td>
                </tr>
                @endforeach --}}
              </tbody>
            </table>

          <div class="panel-footer">

            <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addCustomerDocumentModal">
              <i class="fa fa-plus"></i></button>
            <br>

          </div>

        </div>

        <div class="panel panel-info">
          <div class="panel-heading">Comments (0)</div>
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

            <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addCustomerCommentDocumentModal">
              <i class="fa fa-plus"></i></button>

          </div>

        </div>



      </div>

  </div>





  </div>

  </div>
</div>

@include('partials.modals.edit_customer')
@include('partials.modals.delete_customer')
@include('partials.modals.add_site')

@stop

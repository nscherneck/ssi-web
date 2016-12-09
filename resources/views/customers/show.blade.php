@extends('layout')

@section('title', 'SSI-Web | Customer Record')

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

  <div class="col-md-3">

    <div class="headerBar text-center">
      <h3>{{ $customer->name }}</h3>
    </div>

    <div class="contentBar">
      <p><small>
        {{ $customer->address1 }}<br>
        @if ($customer->address2)
        {{ $customer->address2 }}<br>
        @endif
        @if ($customer->address3)
        {{ $customer->address3 }}<br>
        @endif
        {{ $customer->city }}, {{ $customer->state->state }}  {{ $customer->zip}}<br>
        <a href="http://{{ $customer->web }}" target="blank">{{ $customer->web }}</a>
      </small></p>
    </div>

    <div class="contentBar">

      <p><small>
        Added: {{ $customer->created_at->setTimezone('America/Los_Angeles')->format('F j, Y, g:i a') }}<br>
        Added By: {{ $customer->addedBy->first_name }} {{ $customer->addedBy->last_name }}<br>
        @if($customer->updated_by)
        <br>
        Updated: {{ $customer->updated_at->setTimezone('America/Los_Angeles')->format('F j, Y, g:i a') }}<br>
        Updated By: {{ $customer->updatedBy->first_name }} {{ $customer->updatedBy->last_name }}<br>
        @endif
      </small></p>

    </div>

    @if ($customer->notes)
    <div class="contentBar">

      <p><small>
        <strong>Notes: </strong>
      </small></p>

      <p><small>
        {{ $customer->notes }}
      </small></p>

    </div>
    @endif

    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateCustomerModal">Edit Customer</button>
    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteCustomerModal">Delete Customer</button>
    <br>

  </div>

<!--          RIGHT SIDE CONTENT         -->

  <div class="col-md-9">

    <style>
  button.accordion {
      background-color: #eee;
      color: #444;
      cursor: pointer;
      padding: 10px;
      width: 100%;
      border:1px solid gray;
      border-radius: 5px;
      text-align: left;
      outline: none;
      font-size: 12px;
      transition: 2.8s;
  }

  button.accordion.active, button.accordion:hover {
      background-color: #ddd;
  }

  div.panel {
      padding: 0 2px;
      display: none;
      background-color: white;
  }

  div.panel.show {
      display: block;
  }
  </style>

<button class="accordion">Sites ({{ $customer->count_sites($customer->id) }})</button>
<div class="panel show">

  <table class="table table-striped table-condensed">
    <thead>
      <tr>
        <th><small>Site Name</small></th>
        <th><small>Address</small></th>
        <th><small>City</small></th>
        <th><small>State</small></th>
        <th><small>Systems</small></th>
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
        <td><small>{{ $site->count_systems($site->id) }}</small></td>
        <td><small><a href="https://www.google.com/maps/place//@<?= $site->lat ?>,{{ $site->lon }},18z" target="blank">Map</a></small></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <br>

  <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addSiteModal">Add Site</button>
  <br><br>

</div>

<button class="accordion">Documents</button>
<div class="panel">
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
</div>

<button class="accordion">Comments</button>
<div class="panel">
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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

@include('partials.modals.edit_customer')
@include('partials.modals.delete_customer')
@include('partials.modals.add_site')

@stop

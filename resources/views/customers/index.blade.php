@extends('layout')

@section('title', 'Customers Page')

@section('content')

@include('partials.nav')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">

  <h4>Customers</h4>

  <table class="table table-striped table-condensed">
    <thead>
      <tr>
        <th><small>Customer</small></th>
        <th><small>Sites</small></th>
        <th><small>Systems</small></th>
      </tr>
    </thead>
    <tbody>
      @foreach($customers as $customer)
        <tr>
        <td><small><a href="customer/{{ $customer->id }}">{{ $customer->name }}</a></small></td>
        <td><small>{{ $customer->sites->count() }}</small></td>
        <td><small>{{ $customer->systems->count() }}</small></td>
      </tr>
      @endforeach
    </tbody>
  </table>

    </div>
  </div>
</div>

@stop

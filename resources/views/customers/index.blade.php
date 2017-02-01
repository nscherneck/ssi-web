@extends('layout')

@section('title', 'SSI-Extranet | Customers Index')

@section('content')

<div class="container-fluid">

  @include('partials.nav')

  <div class="btn-group btn-group-sm" role="group" aria-label="..." style="margin: 10px 0; text-decoration: none;">
    <button type="button" class="btn btn-default"><a href="/customers" style="text-decoration: none;">Customers Index</a></button>
    <button type="button" class="btn btn-default"><a href="/sites" style="text-decoration: none;">Sites Index</a></button>
  </div>

</div>

<div class="container">

  <div class="titleBar" style="margin-top: 0">
      <p>Customers Index</p>
  </div>

  <table class="table table-condensed">
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

@stop

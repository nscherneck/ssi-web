@extends('layout')

@section('title', 'SSI-Extranet | Customers Index')

@section('content')

@include('partials.nav')

<div class="container">

  <br><a href="/customers">Customers Index</a> | <a href="/sites">Sites Index</a>

  <div class="titleBar">
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

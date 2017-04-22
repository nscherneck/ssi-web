@extends('layout')

@section('title', 'SSI-Extranet | Customers Lookup')

@section('content')

<div class="container-fluid" style="margin-top: 15px">

  @include('partials.nav')

</div>

<div class="container">

  <div class="titleBar" style="margin-top: 0">
      <p>Customers ({{ $customers->count() }})</p>
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

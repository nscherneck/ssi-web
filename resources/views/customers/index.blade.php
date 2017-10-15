@extends('layout')

@section('title', 'SSI-Extranet | Customers Lookup')

@section('content')

@include('partials.nav')

<div class="container">

  @include('partials.flash')
  <br>
  <div class="text-center">
    <h1>Customers <small>{{ $customers->count() }}</small></h1>
  </div>
  <hr>
  @foreach($customers->chunk(3) as $chunk)
  <div class="row">
    @foreach($chunk as $customer)
      <div class="col-lg-4">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title text-center">
              <a href="{{ $customer->path() }}">{{ $customer->name }}</a>
            </h3>
          </div>
          <div class="panel-body text-center">
            <strong>Sites: </strong><small>{{ $customer->sites_count }}</small> |
            <strong>Systems: </strong><small>{{ $customer->systems_count }}</small>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  @endforeach

{{--   <div class="titleBar" style="margin-top: 0">
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
        <td><small><a href="{{ $customer->path() }}">{{ $customer->name }}</a></small></td>
        <td><small>{{ $customer->sites_count }}</small></td>
        <td><small>{{ $customer->systems_count }}</small></td>
      </tr>
      @endforeach
    </tbody>
  </table> --}}

</div>

@stop

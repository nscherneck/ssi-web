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
  @foreach($customers->chunk(4) as $chunk)
  <div class="row">
    @foreach($chunk as $customer)
      <div class="col-lg-3">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title text-center">
              <a href="{{ $customer->path() }}">{{ $customer->name }}</a>
            </h3>
          </div> <!-- ./panel-heading -->
          <div class="panel-body text-center">
            <strong>Sites: </strong><small>{{ $customer->sites_count }}</small> |
            <strong>Systems: </strong><small>{{ $customer->systems_count }}</small>
          </div> <!-- ./panel-body -->
        </div> <!-- ./panel -->
      </div> <!-- ./column -->
    @endforeach
  </div> <!-- ./row -->
  @endforeach

</div> <!-- ./container -->

@stop

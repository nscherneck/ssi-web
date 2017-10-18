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
        <a class="customer-card" href="{{ $customer->path() }}">
          <div class="panel panel-primary">
            <div class="panel-body text-center">
              <h4 class="customer-card-title text-center">
                {{ $customer->name }}
              </h4>
              <hr class="customer-card">
              <div class="customer-card-bottom-container">
                <div class="customer-card-left">
                  <h4>{{ $customer->sites_count }}</h4>
                  Sites
                </div>
                <div class="customer-card-right">
                  <h4>{{ $customer->systems_count }}</h4>
                  Systems
                </div>
              </div>
            </div> <!-- ./panel-body -->
          </div> <!-- ./panel -->
        </a>
      </div> <!-- ./column -->
    @endforeach
  </div> <!-- ./row -->
  @endforeach

</div> <!-- ./container -->

@stop

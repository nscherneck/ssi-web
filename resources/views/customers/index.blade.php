@extends('layout')

@section('title', 'SSI-Extranet | Customers Lookup')

@section('head')
  <style>
  body {
    background: linear-gradient(#FFF, #E8E8E8);
    background-attachment: fixed;
  }
  </style>
@endsection

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
                @include('partials.icons.customer-icon')
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

  <hr>

  {{-- @can('Create Customer') --}}
    <a href="#"
      class="panel-button"
      data-toggle="modal"
      data-target="#addCustomerModal">
      <div class="col-lg-2 col-lg-offset-5">
        <div class="panel panel-primary">
          <div class="panel-body text-center">
            <h5>New Customer</h5>
          </div> <!-- ./panel-body -->
        </div> <!-- ./panel -->
      </div>
    </a>
  {{-- @endcan --}}

</div> <!-- ./container -->

@include('partials.modals.add_customer')

@endsection

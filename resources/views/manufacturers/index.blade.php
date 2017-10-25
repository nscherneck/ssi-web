@extends('layout')

@section('title', 'SSI-Extranet | Manufacturer')

@section('head')

<style type="text/css">
   body { background: #5F98B9 !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
</style>

@stop

@section('content')

@include('partials.nav')

<div class="container">

  @include('partials.flash')

  <div class="text-center">
    <h1>Manufacturers <small>{{ $manufacturers->count() }}</small></h1>
  </div>
  <hr>
  @foreach($manufacturers->chunk(2) as $chunk)
  <div class="row">
    @foreach($chunk as $manufacturer)
      <div class="col-lg-6">
        <a style="display: block" href="/manufacturer/{{ $manufacturer->id }}">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="manufacturer-card-left">
              <h4>
                {{ $manufacturer->name }}
              </h4>
            </div>
            <div class="manufacturer-card-right text-center">
              <h1>{{ $manufacturer->components->count() }}</h1>
              <h6>Components</h6>
            </div>
          </div> <!-- ./panel-body -->
        </div> <!-- ./panel -->
      </a>
      </div> <!-- ./column -->
    @endforeach
  </div> <!-- ./row -->
  @endforeach

  <hr>

  <a href="#"
    class="panel-button"
    data-toggle="modal"
    data-target="#addManufacturerModal">
    <div class="col-lg-2 col-lg-offset-5">
      <div class="panel panel-primary">
        <div class="panel-body text-center">
          <h5>New Manufacturer</h5>
        </div> <!-- ./panel-body -->
      </div> <!-- ./panel -->
    </div>
  </a>

</div> <!-- END OF CONTAINER -->

@include('partials.modals.add_manufacturer')

@stop

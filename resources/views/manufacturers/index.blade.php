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
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="manufacturer-card-left">
              <h4>
                <a href="/manufacturer/{{ $manufacturer->id }}">
                  {{ $manufacturer->name }}
                </a>
              </h4>
            </div>
            <div class="manufacturer-card-right text-center">
              <h1>{{ $manufacturer->components->count() }}</h1>
              <h6>Components</h6>
            </div>
          </div> <!-- ./panel-body -->
        </div> <!-- ./panel -->
      </div> <!-- ./column -->
    @endforeach
  </div> <!-- ./row -->
  @endforeach

</div> <!-- END OF CONTAINER -->

@stop

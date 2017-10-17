@extends('layout')

@section('title', 'SSI-Extranet | Manufacturer')

@section('head')

<style type="text/css">
   body { background: #5F98B9 !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
</style>

@stop

@section('content')

@include('partials.nav')

<div class="container-fluid">

  @include('partials.flash')

  <div class="col-lg-4 col-lg-offset-4" style="margin-top: 15px">
    @foreach($manufacturers as $manufacturer)
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
        </div>
      </div>
    @endforeach
  </div>

</div> <!-- END OF CONTAINER -->

@stop

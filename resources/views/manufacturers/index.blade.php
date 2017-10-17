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

  <div class="row">

    <div class="col-lg-4 col-lg-offset-4">

        <div class="panel panel-default" style="margin-top: 15px">

    <div class="panel-heading text-center">
      Manufacturers
    </div>

    <table class="table">
      <thead>
        <tr>
          <th><small>Manufacturer</small></th>
          <th class="text-center"><small>Components</small></th>
        </tr>
      </thead>
      <tbody>
        @foreach($manufacturers as $manufacturer)
          <tr>

            <td width="70%">
            <small>
            <a href="/manufacturer/{{ $manufacturer->id }}">
            {{ $manufacturer->name }}
            </a>
            </small>
            </td>

            <td width="30%" class="text-center">
            <small>
            {{ $manufacturer->components->count() }}
            </small>
            </td>

          </tr>
        @endforeach
      </tbody>
    </table>

  </div> <!-- END OF PANEL -->
    </div>

  </div>



</div> <!-- END OF CONTAINER -->

@stop

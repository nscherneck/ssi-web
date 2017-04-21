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

  <div class="row">

    <div class="col-lg-4 col-lg-offset-4">
      
        <div class="panel panel-default" style="margin-top: 15px">

    <div class="panel-heading text-center">
      Manufacturers
    </div>

    <table class="table table-condensed">
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
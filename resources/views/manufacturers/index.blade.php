@extends('layout')

@section('title', 'SSI-Extranet | Manufacturer')

@section('content')

@include('partials.nav')

<div class="container">

  @include('partials.flash')

  <div class="text-center">
    <h3>Manufacturers Index</h3>
  </div>

  <div class="row">

    <div class="col-md-12">

      <div class="titleBar">
          <p>Manufacturers ({{ $manufacturers->count() }})</p>
      </div>

      <div class="table-responsive">

        <table class="table table-condensed">
          <thead>
            <tr>
              <th><small>Manufacturer</small></th>
              <th><small>Website</small></th>
              <th><small>Distributor Website</small></th>
              <th><small>Components</small></th>
            </tr>
          </thead>
          <tbody>
            @foreach($manufacturers as $manufacturer)
              <tr>

              <td width="25%">
              <small><a href="/manufacturer/{{ $manufacturer->id }}">
              {{ $manufacturer->name }}</a></small>
              </td>

              <td width="25%">
              <small><a href="{{ $manufacturer->web }}" target="blank">
              {{ $manufacturer->web }}</a></small>
              </td>

              <td width="25%">
              <small><a href="{{ $manufacturer->distributor_login }}" target="blank">
              {{ $manufacturer->distributor_login }}</a></small>
              </td>

              <td width="25%">
              <small>{{ $manufacturer->components->count() }}</small>
              </td>
              
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>


    </div>

  </div>

</div>

@stop

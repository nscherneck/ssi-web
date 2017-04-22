@extends('layout')

@section('title', 'SSI-Extranet | Systems Lookup')

@section('content')

<div class="container-fluid" style="margin-top: 15px">

  @include('partials.nav')

</div>

<div class="container">

  <div class="titleBar" style="margin-top: 0">
      <p>Systems ({{ $systems->count() }})</p>
  </div>

  <table class="table table-condensed">
        <thead>
          <tr>
            <th><small>Customer</small></th>
            <th><small>Site</small></th>
            <th><small>System</small></th>
            <th><small>Type</small></th>
            <th><small>Components</small></th>
          </tr>
        </thead>

        <tbody>
          @foreach($systems as $system)
            <tr>

            <td><small>
            <a href="/customer/{{ $system->site->customer_id }}">{{ $system->site->customer->name }}</a>
            </small></td>

            <td><small>
            <a href="/system/{{ $system->site->id }}">{{ $system->site->name }}</a>
            </small></td>

            <td><small>
            <a href="/system/{{ $system->id }}">{{ $system->name }}</a>
            </small></td>

            <td><small>
            {{ $system->system_type->type }}
            </small></td>

            <td><small>
            {{ $system->sumComponents() }}
            </small></td>

          </tr>
          @endforeach
        </tbody>

</div>

@stop

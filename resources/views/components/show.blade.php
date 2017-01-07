@extends('layout')

@section('title', 'SSI-Extranet | Test')

@section('content')

@include('partials.nav')

@include('partials.flash')

<div class="container">
  <div class="text-center">

  </div>

  <br>
  <h3>{{ $component->manufacturer->name }}</h3>
  <h5>{{ $component->model }}</h5>
  <br>

  <p>{{ $component->description }}</p>
  <br>

  <div class="titleBar">
      <p>Data Sheets</p>
  </div>
  <br>

  <div class="titleBar">
      <p>Manuals</p>
  </div>
  <br>

  <div class="titleBar">
      <p>Installed At</p>
  </div>

  <div class="table-responsive">

    <table class="table table-condensed">
      <thead>
        <tr>
          <th><small>Customer</small></th>
          <th><small>Site</small></th>
          <th><small>System</small></th>
        </tr>
      </thead>
      <tbody>
        @foreach($component->systems as $system)
          <tr>
          <td><small><a href="/customer/{{ $system->site->customer->id }}">{{ $system->site->customer->name }}</a></small></td>
          <td><small><a href="/site/{{ $system->site->id }}">{{ $system->site->name }}</a></small></td>
          <td><small><a href="/system/{{ $system->id }}">{{ $system->name }}</a></small></td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
  <br>

  <div class="titleBar">
      <p>Comments</p>
  </div>


  </div>
</div>
@stop

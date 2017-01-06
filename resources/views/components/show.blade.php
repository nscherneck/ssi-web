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
      <p>Comments</p>
  </div>


  </div>
</div>
@stop

@extends('layout')

@section('title', 'SSI-Extranet | Installation')

@section('content')

@include('partials.nav')

<div class="container-fluid">
  <h3>Jobs Home</h3>

  @foreach ($customers as $customer)
	  <p>{{ $customer->name }}</p><br>
  @endforeach
</div>

@stop

@extends('layout')

@section('title', 'SSI-Extranet | Engineering')

@section('content')

@include('partials.nav')

<div class="container-fluid">
  <h3>Engineering Page</h3>

  <?php var_dump(date_default_timezone_get()); ?>
</div>

@stop

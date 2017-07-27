@extends('layout')

@section('title', 'SSI-Extranet | Home')

@section('content')

@include('partials.nav')

<div class="container">

  @include('partials.flash')

      <h5>Recent Activity</h5>

      @include('home.activity_feed.feed')

</div> <!-- END OF CONTAINER -->



@stop

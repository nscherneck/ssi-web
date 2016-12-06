@extends('layout')

@section('title', 'SSI-Web | Service')

@section('content')

@include('partials.nav')

@include('partials.flash')

<div class="container-fluid">
  <h3>Admin Page</h3>
  <hr>
  <h5>Customers</h5>
  <ul>
    <li><a href="/customers/create">Add a Customer</a></li>
  </ul>

  <h5>Systems</h5>
  <ul>
    <li><a href="/createsystemtype">Add a System Type</a></li>
  </ul>

  <h5>Components</h5>
  <ul>
    <li><a href="/createmanufacturer">Add a Manufacturer</a></li>
    <li><a href="/createcomponent">Add a Component</a></li>
  </ul>

  <h5>Tests</h5>
  <ul>
    <li><a href="#">Add a Test Type</a></li>
    <li><a href="#">Delete a Test Type</a></li>
    <li><a href="#">Add a Test Result</a></li>
    <li><a href="#">Delete a Test Result</a></li>
</div>

@stop

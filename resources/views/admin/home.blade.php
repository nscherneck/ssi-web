@extends('layout')

@section('title', 'SSI-Extranet | Admin')

@section('head')
  <style>
  body {
    background: linear-gradient(#FFF, #E8E8E8);
    background-attachment: fixed;
  }
  </style>
@endsection

@section('content')

@include('partials.nav')

<div class="row">
  <div class="col-lg-2 sidebar">
    <br>
    <ul class="nav nav-sidebar">
      <li><a href="/admin/branchoffices">Branch Offices</a></li>
      <li><a href="/admin/users">Users</a></li>
      <li><a href="/admin/roles">Roles</a></li>
      <li><a href="/admin/permissions">Permissions</a></li>
      <li><a href="#">Employee Types</a></li>
    </ul>
    <ul class="nav nav-sidebar">
      <li><a href="">Site Categories</a></li>
    </ul>
    <ul class="nav nav-sidebar">
      <li><a href="/admin/systemtypes">System Types</a></li>
      <li><a href="">Test Types</a></li>
      <li><a href="">Test Results</a></li>
    </ul>
  </div> <!-- ./column -->
  <div class="col-lg-10 main">
    <div class="container-fluid">
    @include('partials.flash')
    <div class="text-center">
      <h2>
        @section('admin-title')
          Admin Dashboard
        @show
      </h2>
    </div>
    <hr>
    <div class="container-fluid">
      @yield('admin-content')
    </div>
  </div>
</div> <!-- ./row -->
</div> <!-- ./container -->

@endsection

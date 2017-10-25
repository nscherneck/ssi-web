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

<div class="container-fluid">

@include('partials.flash')
<br>
<div class="row">
    <div class="col-lg-2 sidebar">
      <ul class="nav nav-sidebar">
        <li class="active"><a href="#">Branch Offices <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Users</a></li>
        <li><a href="#">Roles</a></li>
        <li><a href="#">Permissions</a></li>
        <li><a href="#">Employee Types</a></li>
      </ul>
      <ul class="nav nav-sidebar">
        <li><a href="">Site Categories</a></li>
      </ul>
      <ul class="nav nav-sidebar">
        <li><a href="">System Types</a></li>
        <li><a href="">Test Types</a></li>
        <li><a href="">Test Results</a></li>
      </ul>
    </div> <!-- ./column -->
    <!--          -->
  <div class="row">
    <div class="text-center">

    </div>
    <hr>
    <div class="col-lg-4 col-md-offset-3">
      <a href="#"
        class="panel-button"
        data-toggle="modal"
        data-target="#addCustomerModal">
        <div class="panel panel-default">
          <div class="panel-body text-center">
            <h4>New Customer</h4>
          </div> <!-- ./panel-body -->
        </div> <!-- ./panel -->
      </a>
    </div> <!-- ./column -->
  </div> <!-- ./row -->

  <hr>

  <div class="row">
      <div class="col-lg-4 col-md-offset-4">
        <a href="#"
          class="panel-button"
          data-toggle="modal"
          data-target="#addManufacturerModal">
          <div class="panel panel-default">
            <div class="panel-body text-center">
              <h4>New Manufacturer</h4>
            </div> <!-- ./panel-body -->
          </div> <!-- ./panel -->
        </a>
      </div> <!-- ./column -->
  </div> <!-- ./row -->

          <div class="row">
              <div class="col-lg-4 col-md-offset-4">
                <a href="component/create"
                  class="panel-button"">
                  <div class="panel panel-default">
                    <div class="panel-body text-center">
                      <h4>New Component</h4>
                    </div> <!-- ./panel-body -->
                  </div> <!-- ./panel -->
                </a>
              </div> <!-- ./column -->
          </div> <!-- ./row --></div>        </div> <!-- ./panel -->
        </a>
      </div> <!-- ./column -->
  </div> <!-- ./row --></div>

</div>

@include('partials.modals.add_customer')
@include('partials.modals.add_manufacturer')

@endsection

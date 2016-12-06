@extends('layout')
@section('title', 'SSI-Web | Add Site')

@section('content')

@include('partials.nav')

<div class="container-fluid">

  <br>
  <a href="<?php echo url('customers'); ?>">Customers</a> / <a href="/customer/{{ $customer->id }}">{{ $customer->name }}</a>
  / New Site

  <div class="row">
    <div class="col-md-4">

  <h4>Add a New Site</h4>
  <form action="/customer/{{ $customer->id }}/site" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
      Site Name: <input type="text" name="name" value="" class="form-control"><br>
      Address: <input type="text" name="address1" value="" class="form-control"><br>
      Address: <input type="text" name="address2" value="" class="form-control"><br>
      City: <input type="text" name="city" value="" class="form-control"><br>
      State (i.e. OR): <input type="text" name="state" value="" class="form-control"><br>
      Zip Code: <input type="text" name="zip" value="" class="form-control"><br>
      Latitude: <input type="text" id="lat" name="lat" value="" class="form-control"><br>
      Longitude: <input type="text" id="lon" name="lon" value="" class="form-control"><br>
      Phone: <input type="text" name="phone" value="" class="form-control"><br>
      Fax: <input type="text" name="fax" value="" class="form-control"><br>
      Notes: <textarea name="notes" class="form-control">Site notes</textarea><br>
      <button type="submit" class="btn btn-primary">Add Site</button>
    </div>
  </form>

</div>
</div>

  <script src="{{ URL::asset('js/add_site_form.js') }}"></script>

@stop

@extends('layout')
@section('title', 'SSI-Web | Edit Site')

@section('content')

@include('partials.nav')

<div class="container-fluid">

  <br>
  <a href="<?php echo url('customers'); ?>">Customers</a> / <a href="/customer/{{ $customer->id }}">{{ $customer->name }}</a>
  / <a href="/site/{{ $site->id }}">{{ $site->name }}</a> / Edit Site

  <div class="row">
    <div class="col-md-4">
  <br>
  <h4>Edit Site</h4>
  <br>
  <form action="/site/{{ $site->id }}" method="POST">
    {{ method_field('PATCH') }}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
      <small>
      Site Name: <input type="text" name="name" value="{{ $site->name }}" class="form-control"><br>
      Address: <input type="text" name="address1" value="{{ $site->address1 }}" class="form-control"><br>
      Address: <input type="text" name="address2" value="{{ $site->address2 }}" class="form-control"><br>
      City: <input type="text" name="city" value="{{ $site->city }}" class="form-control"><br>
      State (i.e. OR): <input type="text" name="state" value="{{ $site->state }}" class="form-control"><br>
      Zip Code: <input type="text" name="zip" value="{{ $site->zip }}" class="form-control"><br>
      Latitude: <input type="text" name="lat" value="{{ $site->lat }}" class="form-control"><br>
      Longitude: <input type="text" name="lon" value="{{ $site->lon }}" class="form-control"><br>
      Phone: <input type="text" name="phone" value="{{ $site->phone }}" class="form-control"><br>
      Fax: <input type="text" name="fax" value="{{ $site->fax }}" class="form-control"><br>
      Notes: <textarea name="notes" class="form-control">{{ $site->notes }}</textarea><br>
    </small>
      <button type="submit" class="btn btn-primary">Update Site</button>
    </div>
  </form>

</div>
</div>

@stop

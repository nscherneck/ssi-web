@extends('layout')
@section('title', 'SSI-Web | New Customer')

@section('content')

@include('partials.nav')

<div class="container">

  <div class="row">
    <div class="col-md-4">

  <h4>New Customer</h4>

    <form action="/customers/create" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group row">
        <label for="name" class="col-2 col-form-label">* Name</label>
        <div class="col-10">
          <input required name="name" type="text" value="" class="form-control">
        </div>
      </div>

      <div class="form-group row">
        <label for="address1" class="col-2 col-form-label">* Address</label>
        <div class="col-10">
          <input required name="address1" type="text" value="" class="form-control">
        </div>
      </div>

      Address:  <input name="address2" type="text" value="" class="form-control"><br>
      Address:  <input name="address3" type="text" value="" class="form-control"><br>

      <div class="form-inline">
        <label class="" for="city">* City</label>
        <input required name="city" type="text" value="" class="form-control mb-2 mr-sm-2 mb-sm-0">

        <label class="" for="state">* State</label>
        <select  required name="state_id" class="input-group mb-2 mr-sm-2 mb-sm-0">
          @foreach($states as $state)
            <option value="{{ $state->id }}">{{ $state->state }}</option>
          @endforeach
        </select>
      </div>

      * Zip:  <input required name="zip" type="text" value="" class="form-control"><br>
      Phone:  <input name="phone" type="tel" value="" placeholder="XXX-XXX-XXXX" class="form-control"><br>
      Fax:  <input name="fax" type="tel" value="" class="form-control"><br>
      Website:  <input name="web" type="url" value="" placeholder="http://www.example.com" class="form-control"><br>
      Email:  <input name="email" type="email" value="" class="form-control"><br>
      Notes:  <textarea name="notes" class="form-control"></textarea><br>
      <br>
      <button type="submit" class="btn btn-primary">Create Customer</button>

  </form>

    </div>
  </div>

</div>

<script src="{{ URL::asset('js/add_customer_form.js') }}"></script>


@stop

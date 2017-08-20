@extends('layout')
@section('title', 'SSI-Web | Add System Type')

@section('content')

@include('partials.nav')

<div class="container-fluid">

  <div class="row">
    <div class="col-md-4">

  <h4>Add System Type</h4>
  <ul>
    @foreach($systemTypes as $systemType)
      <li>{{ $systemType->type }}</li>
      @endforeach
  </ul>

  <form action="/createsystemtype" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
      Type: <input type="text" name="type" value="" class="form-control">
      <br>
      <button type="submit" class="btn btn-primary">Add System Type</button><br><br>

      @if(count($errors))
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      @endif

    </div>
  </form>
  <br>

</div>
</div>

@stop

@extends('layout')
@section('title', 'SSI-Web | Create Component')

@section('content')

@include('partials.nav')

<div class="container-fluid">

  <div class="row">
    <div class="col-md-4">

      <br>
      <h4>Create a New Component</h4>

        <form action="/createcomponent" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">

          Manufacturer: <select name="manufacturer_id" class="form-control" required>
              <option value="" disabled selected>Select</option>
            @foreach ($manufacturers as $manufacturer)
              <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
            @endforeach
          </select><br>


          Model: <input type="text" name="model" class="form-control" required><br>

          <textarea name="description" class="form-control" placeholder="Component description" required></textarea><br>

          Category: <select name="component_category_id" class="form-control" required>
              <option value="">Select Category</option>
            @foreach ($component_categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select><br>

          Discontinued Part: <select id="model" name="discontinued" class="form-control">
            <option value="0">No</option>
            <option value="1">Yes</option>
          </select><br>

          <button type="submit" class="btn btn-primary">Create Component</button><br><br>

          @if(count($errors))
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif

        </div>
      </form>

</div>
</div>

@stop

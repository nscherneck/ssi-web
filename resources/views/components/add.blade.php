@extends('layout')
@section('title', 'SSI-Web | Attach Component')

@section('content')

@include('partials.nav')

<script   src="http://code.jquery.com/jquery-3.1.1.js"   integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="   crossorigin="anonymous"></script>

<script>

function fetch_select(val)
{

 $.ajax({
 type: 'post',
 url: '/update_component_form',
 data: {
  manufacturer_id:val
 },
 dataType: "json",
// success: function (data) {
//     console.log(data);
// }
 success: function (data) {

  var select_model = document.getElementById("model");
  var description_content = document.getElementById("description");


  // clear out previous options
  select_model.innerHTML = "";
  // clear out description
  description_content.innerHTML = "";


  descriptions = new Object();

  for (var i=0; i<data.length; i++) {
  select_model.options[select_model.options.length] = new Option(data[i].model, data[i].id);
  var opts = (select_model.childNodes);
  opts[i].setAttribute("data-parent", i);
  opts[i].setAttribute("class", "model_option");
  descriptions[i] = data[i].description;
}
  console.log(descriptions);
  $("#description").text(descriptions[0]);
  return descriptions;

}

 });

}

</script>

<div class="container-fluid">

  <br>
  <a href="<?php echo url('customers'); ?>">Customers</a> / <a href="/customer/{{ $customer->id }}">{{ $customer->name }}</a> / <a href="/site/{{ $site->id }}">{{ $site->name }}</a>
  / <a href="/system/{{ $system->id }}">{{ $system->name }}</a> / Add Component

  <div class="row">
    <div class="col-md-4">

  <h4>Attach a Component</h4>
    <form action="/system/{{ $system->id }}/attachcomponent" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
      Name:  <input  name="name" type="text" value="" class="form-control"><br>
      Quantity:  <input  name="quantity" type="text" value="" class="form-control"><br>
      Manufacturer: <select name="manufacturer_id" class="form-control" onchange="fetch_select(this.value);">
          <option value="">Select Manufacturer</option>
        @foreach ($manufacturers as $manufacturer)
          <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
        @endforeach
      </select><br>
      Model: <select id="model" name="component_id" class="form-control">
        <option id="default">Choose Manufacturer</option>
      </select><br>
      Description:<br>
      <div class="description" style="width:100%; padding:1em;">
        <p id="description"></p>
      </div>

      <script>
        document.getElementById("model").addEventListener("change", function() {
          var select_model = document.getElementById("model");
          var obj_index = select_model.options[select_model.selectedIndex].dataset.parent;
          console.log(descriptions[obj_index]);
          // var desc_content_area = document.getElementById("description");
          // desc_content_area.innerHTML(data[obj_index].description);
          var description_content = document.getElementById("description");
          description_content.innerHTML = descriptions[obj_index];
          // $("#description").text(descriptions[obj_index]);

        });
      </script>

      <br>
      <button type="submit" class="btn btn-primary">Attach Component</button>
    </div>
  </form>
  <a href="/createcomponent"><small>Create a New Component</small></a>

</div>
</div>

@stop

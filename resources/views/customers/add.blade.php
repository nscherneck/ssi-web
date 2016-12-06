@extends('layout')
@section('title', 'SSI-Web | New Customer')

@section('content')

@include('partials.nav')

<script   src="http://code.jquery.com/jquery-3.1.1.js"   integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="   crossorigin="anonymous"></script>

<!-- <script>

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

</script> -->

<div class="container-fluid">

  <div class="row">
    <div class="col-md-4">

  <h4>New Customer</h4>
    <form action="/customers/create" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
      Name:  <input name="name" type="text" value="" class="form-control"><br>
      Address:  <input name="address1" type="text" value="" class="form-control"><br>
      Address:  <input name="address2" type="text" value="" class="form-control"><br>
      Address:  <input name="address3" type="text" value="" class="form-control"><br>
      City:  <input name="city" type="text" value="" class="form-control"><br>
      State:  <select name="state_id" class="form-control">
        @foreach($states as $state)
          <option value="{{ $state->id }}">{{ $state->state }}</option>
        @endforeach
      </select><br>
      Zip:  <input name="zip" type="text" value="" class="form-control"><br>
      Phone:  <input name="phone" type="text" value="" class="form-control"><br>
      Fax:  <input name="fax" type="text" value="" class="form-control"><br>
      Website:  <input name="web" type="text" value="" class="form-control"><br>
      Email:  <input name="email" type="text" value="" class="form-control"><br>
      Notes:  <textarea name="notes" class="form-control"></textarea><br>

      <!-- <script>
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
      </script> -->

      <br>
      <button type="submit" class="btn btn-primary">Create Customer</button>
    </div>
  </form>

</div>
</div>

@stop

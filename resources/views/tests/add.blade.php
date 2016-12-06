@extends('layout')
@section('title', 'SSI-Web | New Test')

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

  <h4>New Test</h4>

    <form action="/system/{{ $system->id }}/tests/store" method="POST">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group">

      Date of Completion: <input type="date" name="test_date" value="" class="form-control"><br>

      Technician: <select name="technician_id" class="form-control">
          <option value="0">Select Technician</option>
        @foreach ($technicians as $technician)
          <option value="{{ $technician->id }}">{{ $technician->first_name }} {{ $technician->last_name }}</option>
        @endforeach
      </select><br>

      Type: <select name="test_type_id" class="form-control">
          <option value="0">Select Test Type</option>
        @foreach ($test_types as $test_type)
          <option value="{{ $test_type->id }}">{{ $test_type->name }}</option>
        @endforeach
      </select><br>

      Result: <select name="test_result_id" class="form-control">
          <option value="0">Select Test Result</option>
        @foreach ($test_results as $test_result)
          <option value="{{ $test_result->id }}">{{ $test_result->name }}</option>
        @endforeach
      </select><br>

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
      <button type="submit" class="btn btn-primary">Create Test</button>
    </div>
  </form>

</div>
</div>

@stop

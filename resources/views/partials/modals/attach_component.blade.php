<script>

function fetch_select(val)
{

 $.ajax({
 type: 'post',
 url: "/update_component_form",
 data: {
  manufacturer_id:val
 },
 dataType: "json",

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


<!-- attach component modal -->
<div
  class="modal fade"
  id="attachComponentModal"
  role="dialog"
  tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Attach Component</h5>
      </div>
      <div class="modal-body">

        <form action="/systems/{{ $system->id }}/component/attach" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">

          <input name="name" type="text" value="" class="form-control" placeholder="Note" ><br>
          <input id="quantity" name="quantity" type="text" value="" class="form-control" placeholder="Quantity" required><br>
          <select name="manufacturer_id" class="form-control" onchange="fetch_select(this.value);" required>
              <option value="" disabled selected>Choose Manufacturer</option>
            @foreach ($manufacturers as $manufacturer)
              <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
            @endforeach
          </select><br>
          <select id="model" name="component_id" class="form-control" required>
            <option id="default">Model - Choose Manufacturer Above</option>
          </select>

          <div class="description" style="width:100%; padding: 1em 0.25em 0 0.25em;">
            <p id="description"></p>
          </div>

          <script>
            document.getElementById("model").addEventListener("change", function() {
              var select_model = document.getElementById("model");
              var obj_index = select_model.options[select_model.selectedIndex].dataset.parent;
              console.log(descriptions[obj_index]);
              var description_content = document.getElementById("description");
              description_content.innerHTML = descriptions[obj_index];

            });
          </script>

        </div>

      </div>
      <div class="modal-footer">
        <button id="attachButton" type="submit" class="btn btn-primary">Attach</button>
      </div>
    </form>

    </div>
  </div>
</div>

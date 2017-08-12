<!-- edit Deficiency Modal -->
<div
  class="modal fade"
  id="update{{ $deficiency->id }}DeficiencyModal"
  role="dialog"
  tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Deficiency  </h5>
      </div>
      <div class="modal-body">

        <form action="/tests/{{ $test->id }}/deficiencies/{{ $deficiency->id }}/update" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="put">

        <div class="form-group">

          <textarea name="description" class="form-control" rows="3" id="description">{{ $deficiency->description }}</textarea>

          <br>
          <button type="submit" class="btn btn-default">Update</button>
        </div>
      </form>

      </div>
    </div>
  </div>
</div>

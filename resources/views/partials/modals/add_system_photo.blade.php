<!-- add Deficiency Modal -->
<div class="modal fade" id="addSystemPhotoModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add Photo</h5>
      </div>
      <div class="modal-body">

      <form action="/system/{{ $system->id }}/photo/create" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">

          <input type="file" name="image" accept="image/*"><br>
          Caption:<br>
          <textarea rows="4" name="caption" style="width: 80%"></textarea><br><br>

          <button type="submit" class="btn btn-primary">Add</button>

        </div>
      </form>

      </div>
    </div>
  </div>
</div>

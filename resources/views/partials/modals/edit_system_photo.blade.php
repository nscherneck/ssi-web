<!-- edit Deficiency Modal -->
<div class="modal fade" id="updateSystemPhotoModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Photo</h5>
      </div>
      <div class="modal-body text-center">

        <form action="/system/photo/{{ $photo->id }}" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="put">

        <div class="form-group">

          <textarea name="caption" class="form-control" rows="3" id="caption">{{ $photo->caption }}</textarea>

          <br>
          <button type="submit" class="btn btn-default">Update</button>
        </div>
      </form>

      </div>
    </div>
  </div>
</div>

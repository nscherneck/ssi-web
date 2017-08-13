<!-- add System Photo Modal -->
<div
  class="modal fade"
  id="addSystemPhotoModal"
  role="dialog"
  tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add a Photo</h5>
      </div>
      <div class="modal-body text-center">

      <form action="/systems/{{ $system->id }}/photos" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">

          <input type="file" name="image" accept="image/*" required><br>
          Caption:<br>
          <textarea rows="4" name="caption" style="width: 80%"></textarea><br><br>

          <button type="submit" class="btn btn-primary">Add</button>

        </div>
      </form>

      </div>
    </div>
  </div>
</div>

<!-- add System Document Modal -->
<div
  class="modal fade"
  id="addSystemDocumentModal"
  role="dialog"
  tabindex="-1">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add Document</h5>

      </div>

      <div class="modal-body text-center">

        <div class="form-group">

          <form action="/systems/{{ $system->id }}/document" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <input type="file" name="document" accept="file/*"><br>
            Description:<br>
            <textarea rows="4" name="description" style="width: 80%"></textarea><br><br>

            <button type="submit" class="btn btn-primary">Add</button>

          </form>

        </div>

      </div>
    </div>
  </div>
</div>

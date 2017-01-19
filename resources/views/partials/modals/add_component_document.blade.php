<!-- add Test Report Modal -->
<div class="modal fade" id="addComponentDocumentModal" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add Document</h5>

      </div>

      <div class="modal-body text-center">

        <div class="form-group">

          <form action="/component/{{ $component->id }}/document" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <input type="file" name="document" accept="file/*"><br>

        <div class="modal-footer">

          <button type="submit" class="btn btn-primary">Add</button>

        </div>

          </form>

        </div>

      </div>
    </div>
  </div>
</div>

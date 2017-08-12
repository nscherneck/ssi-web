<!-- delete System Document Modal -->
<div
  class="modal fade"
  id="delete{{ $document->id }}SystemDocumentModal"
  role="dialog"
  tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body text-center">

        <p>
          Delete this document?
        </p>

        <form action="/systems/document/{{ $document->id }}" method="post" accept-charset="UTF-8">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="delete">

          <br>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>

      </div>


      </div>
    </div>
  </div>

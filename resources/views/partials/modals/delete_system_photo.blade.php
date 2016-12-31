<!-- add Deficiency Modal -->
<div class="modal fade" id="deleteSystemPhotoModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body text-center">

        <p>
          Delete this photo?
        </p>

          <form action="/system/{{ $system->id }}/photo/{{ $photo->id }}" method="post" accept-charset="UTF-8">
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

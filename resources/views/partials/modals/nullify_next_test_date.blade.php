<!-- add Deficiency Modal -->
<div class="modal fade" id="nullifyNextTestDateModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body text-center">

        <p>
          Remove Next Test Due Date?
        </p>

        <form action="/system/{{ $system->id }}/nullify_next_test_date" method="post" accept-charset="UTF-8">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="put">
          <br>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>

      </div>


      </div>
    </div>
  </div>

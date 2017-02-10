<!-- add Deficiency Modal -->
<div class="modal fade" id="addTestnoteModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add Note</h5>

      </div>

      <div class="modal-body">

        <div class="form-group">

          <form action="/tests/{{ $test->id }}/testnotes/store" method="POST">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <textarea name="note" class="form-control" rows="3" id="note" required></textarea><br>

            <button type="submit" class="btn btn-primary">Add</button>

          </form>

        </div>

      </div>
    </div>
  </div>
</div>

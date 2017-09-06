<!-- add Deficiency Modal -->
<div
  class="modal fade"
  id="addDeficiencyModal"
  role="dialog"
  tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add Deficiency  </h5>

      </div>

      <div class="modal-body">

        <div class="form-group">

          <form action="/tests/{{ $test->id }}/deficiencies/store" method="POST">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <textarea name="description" class="form-control" rows="3" id="description" required></textarea><br>

            <button type="submit" class="btn btn-primary">Add</button>

          </form>

        </div>

      </div>
    </div>
  </div>
</div>

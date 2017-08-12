<!-- edit Next Test Date Modal -->
<div
  class="modal fade"
  id="updateNextTestDateModal"
  role="dialog"
  tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Next Test Date</h5>
      </div>
      <div class="modal-body text-center">

        <form action="/system/{{ $system->id }}/update_next_test_date" method="POST">

          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="put">

          <div class="form-group">

            Next Test Date: <input type="date" name="next_test_date" value="{{ $system->next_test_date->format('Y-m-d') }}" class="form-control"><br>

            <br>
            <button type="submit" class="btn btn-default">Update</button>

          </div>

        </form>

      </div>
    </div>
  </div>
</div>

<!-- add Deficiency Modal -->
<div class="modal fade" id="delete{{ $report->id }}ReportModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body text-center">

        <p>
          Delete this report?
        </p>

          <form action="/test/{{ $test->id }}/report/{{ $report->id }}" method="post" accept-charset="UTF-8">
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

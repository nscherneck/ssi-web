<!-- add Test Report Modal -->
<div class="modal fade" id="addReportModal" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add Report</h5>

      </div>

      <div class="modal-body">

        <div class="form-group">

          <form action="/test/{{ $test->id }}/report/store" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <input type="file" name="report" accept="file/*"><br>
            Description:<br>
            <textarea rows="4" cols="80" name="description"></textarea><br><br>

            <button type="submit" class="btn btn-primary">Add</button>

          </form>

        </div>

      </div>
    </div>
  </div>
</div>

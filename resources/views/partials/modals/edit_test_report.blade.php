<!-- edit Deficiency Modal -->
<div class="modal fade" id="update{{ $report->id }}ReportModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Report Description</h5>
      </div>
      <div class="modal-body text-center">

        <form action="/test/{{ $test->id }}/report/{{ $report->id }}" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="put">

        <div class="form-group">

          <textarea name="description" class="form-control" rows="3" id="caption">{{ $report->description }}</textarea>

          <br>
          <button type="submit" class="btn btn-default">Update</button>
        </div>
      </form>

      </div>
    </div>
  </div>
</div>

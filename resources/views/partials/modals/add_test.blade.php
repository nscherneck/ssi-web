<!-- add Test Modal -->
<div class="modal fade" id="addTestModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add Test</h5>
      </div>
      <div class="modal-body form-horizontal">

        <form action="/system/{{ $system->id }}/tests/store" method="POST">

          <input type="hidden" name="_token" value="{{ csrf_token() }}">

           <div class="form-group">
            <label for="test_date" class="col-sm-2 control-label"><small>Test Date</small></label>
            <div class="col-sm-10">
              <input type="date" name="test_date" value="{{ $now }}" class="form-control" required>
            </div>
          </div>

           <div class="form-group">
            <label for="technician_id" class="col-sm-2 control-label"><small>Technician</small></label>
            <div class="col-sm-10">
              <select name="technician_id" class="form-control" required>
                  <option value="" disabled selected>Select</option>
                @foreach ($technicians as $technician)
                  <option value="{{ $technician->id }}">{{ $technician->first_name }} {{ $technician->last_name }}</option>
                @endforeach
              </select>
            </div>
          </div>

           <div class="form-group">
            <label for="test_type_id" class="col-sm-2 control-label"><small>Test Type</small></label>
            <div class="col-sm-10">
              <select name="test_type_id" class="form-control" required>
                  <option value="" disabled selected>Select</option>
                @foreach ($testTypes as $testType)
                  <option value="{{ $testType->id }}">{{ $testType->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

           <div class="form-group">
            <label for="test_result_id" class="col-sm-2 control-label"><small>Test Result</small></label>
            <div class="col-sm-10">
              <select name="test_result_id" class="form-control" required>
                  <option value="" disabled selected>Select</option>
                @foreach ($testResults as $testResult)
                  <option value="{{ $testResult->id }}">{{ $testResult->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" class="btn btn-primary">Add</button>

      </div>

        </form>

    </div>
  </div>
</div>

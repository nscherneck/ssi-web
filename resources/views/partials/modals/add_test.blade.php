<!-- add Deficiency Modal -->
<div class="modal fade" id="addTestModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add Test</h5>
      </div>
      <div class="modal-body">

        <form action="/system/{{ $system->id }}/tests/store" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">

          Date of Completion: <input type="date" name="test_date" value="" class="form-control"><br>

          Technician: <select name="technician_id" class="form-control">
              <option value="">Select Technician</option>
            @foreach ($technicians as $technician)
              <option value="{{ $technician->id }}">{{ $technician->first_name }} {{ $technician->last_name }}</option>
            @endforeach
          </select><br>

          Type: <select name="test_type_id" class="form-control">
              <option value="">Select Test Type</option>
            @foreach ($test_types as $test_type)
              <option value="{{ $test_type->id }}">{{ $test_type->name }}</option>
            @endforeach
          </select><br>

          Result: <select name="test_result_id" class="form-control">
              <option value="">Select Test Result</option>
            @foreach ($test_results as $test_result)
              <option value="{{ $test_result->id }}">{{ $test_result->name }}</option>
            @endforeach
          </select><br>


          <br>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>

      </div>
    </div>
  </div>
</div>

<!-- edit Test Modal -->
<div class="modal fade" id="updateTestModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit test</h5>
      </div>
      <div class="modal-body">

        <form action="/tests/{{ $test->id }}/update" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="put">

        <div class="form-group">

          Date of Completion: <input type="date" name="test_date" value="{{ $test->test_date->format('Y-m-d') }}" class="form-control"><br>

          Technician: <select name="technician_id" class="form-control">
              <option value="{{ $test->technician->id}}">{{ $test->technician->first_name }} {{ $test->technician->last_name }}</option>
            @foreach ($technicians as $technician)
              <option value="{{ $technician->id }}">{{ $technician->first_name }} {{ $technician->last_name }}</option>
            @endforeach
          </select><br>

          Type: <select name="test_type_id" class="form-control">
              <option value="{{ $test->test_type->id }}">{{ $test->test_type->name }}</option>
            @foreach ($test_types as $test_type)
              <option value="{{ $test_type->id }}">{{ $test_type->name }}</option>
            @endforeach
          </select><br>

          Result: <select name="test_result_id" class="form-control">
              <option value="{{ $test->test_result->id }}">{{ $test->test_result->name }}</option>
            @foreach ($test_results as $test_result)
              <option value="{{ $test_result->id }}">{{ $test_result->name }}</option>
            @endforeach
          </select><br>

          <br>
          <button type="submit" class="btn btn-default">Update</button>
        </div>
      </form>

      </div>
    </div>

  </div>
</div>

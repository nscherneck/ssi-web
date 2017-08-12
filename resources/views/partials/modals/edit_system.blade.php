<!-- edit System Modal -->
<div
  class="modal fade"
  id="updateSystemModal"
  role="dialog"
  tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit System</h5>
      </div>
      <div class="modal-body">

        <form action="/systems/{{ $system->id }}/update" method="POST">

          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="put">

          <div class="form-group">

            Name: <input type="text" name="name" value="{{ $system->name }}" class="form-control"><br>
            Type: <select name="system_type_id" class="form-control">
                <option value="{{ $system->system_type_id }}">{{ $system->system_type->type }}</option>
              @foreach ($system_types as $system_type)
                <option value="{{ $system_type->id }}">{{ $system_type->type }}</option>
              @endforeach
            </select><br>
            Installation Date: <input type="date" name="install_date" value="{{ $system->install_date->format('Y-m-d') }}" class="form-control"><br>
            Installed by SSI: <select name="ssi_install" class="form-control">
              <option value="{{ $system->ssi_install }}">@if($system->ssi_install == 0) No @elseif($system->ssi_install == 1) Yes @endif</option>
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
            <br>
            Tests & Inspections by SSI: <select name="ssi_test_acct" class="form-control">
              <option value="{{ $system->ssi_test_acct }}">@if($system->ssi_test_acct == 0) No @elseif($system->ssi_test_acct == 1) Yes @endif</option>
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
            <br>
            <textarea name="notes" class="form-control" rows="5" placeholder="System Notes">{{ $system->notes }}</textarea>

          </div>

    </div>

    <div class="panel-footer">
      <button type="submit" class="btn btn-default">Update</button>
    </div>

  </form>

    </div>
  </div>
</div>

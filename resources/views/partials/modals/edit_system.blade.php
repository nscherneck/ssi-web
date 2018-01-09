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

        <form action="/systems/{{ $system->id }}" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="put">

        <div class="form-group">

          Name: <input type="text" name="name" value="{{ $system->name }}" class="form-control"><br>
          Type: <select name="system_type_id" class="form-control">
              <option value="{{ $system->system_type_id }}">{{ $system->systemType->type }}</option>
            @foreach ($systemTypes as $systemType)
              <option value="{{ $systemType->id }}">{{ $systemType->type }}</option>
            @endforeach
          </select><br>
          Installation Date: <input type="date" name="install_date" value="{{ $system->install_date->format('Y-m-d') }}" class="form-control"><br>
          
          <textarea name="notes" class="form-control no-resize" rows="5" placeholder="System Notes">{{ $system->notes }}</textarea>
          <br>
          
          <div class="row">
            <div class="col-lg-4 text-left">
              <label>
                <input type="checkbox" name="is_active" value="1" @if($system->is_active) checked @endif>
                <small>Active?</small>
              </label>
            </div>
            <div class="col-lg-4 text-center">
              <label>
                <input type="checkbox" name="ssi_test_acct" value="1" @if($system->ssi_test_acct) checked @endif>
                <small>Tests by SSI?</small>
              </label>
            </div>
            <div class="col-lg-4 text-right">
              <label>
                <input type="checkbox" name="ssi_install" value="1" @if($system->ssi_install) checked @endif>
                <small>Installed by SSI?</small>
              </label>
            </div>
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Update</button>

        </div>

    </div>


  </form>

    </div>
  </div>
</div>

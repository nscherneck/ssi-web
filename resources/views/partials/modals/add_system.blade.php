<!-- add System Modal -->
<div
  class="modal fade"
  id="addSystemModal"
  role="dialog"
  tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add System</h5>
      </div>
      <div class="modal-body">

        <form action="/sites/{{ $site->id }}/systems" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">

          <input type="text" name="name" value="" class="form-control" placeholder="System Name" required><br>
          <select name="system_type_id" class="form-control" required>
              <option value="0" disabled selected>Select System Type</option>
            @foreach ($systemTypes as $systemType)
              <option value="{{ $systemType->id }}">{{ $systemType->type }}</option>
            @endforeach
          </select><br>
          Installation Date: <input type="date" name="install_date" value="2000-01-01" class="form-control">
          <br>
          
          <textarea name="notes" class="form-control no-resize" placeholder="System Notes" rows="4"></textarea>
          <br>
          
          <div class="row">
            <div class="col-lg-4 text-left">
              <label>
                <input type="checkbox" name="is_active" value="1" checked>
                <small>Active?</small>
              </label>
            </div>
            <div class="col-lg-4 text-center">
              <label>
                <input type="checkbox" name="ssi_test_acct" value="1" checked>
                <small>Tests by SSI?</small>
              </label>
            </div>
            <div class="col-lg-4 text-right">
              <label>
                <input type="checkbox" name="ssi_install" value="1">
                <small>Installed by SSI?</small>
              </label>
            </div>
          </div>
          <br>

          <button type="submit" class="btn btn-primary">Create System</button>
        </div>
      </form>

      </div>
    </div>
  </div>
</div>

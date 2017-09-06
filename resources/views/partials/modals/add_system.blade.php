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

        <form action="/site/{{ $site->id }}/systems" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">

          <input type="text" name="name" value="" class="form-control" placeholder="System Name" required><br>
          <select name="system_type_id" class="form-control" required>
              <option value="0" disabled selected>Select System Type</option>
            @foreach ($systemTypes as $systemType)
              <option value="{{ $systemType->id }}">{{ $systemType->type }}</option>
            @endforeach
          </select><br>
          Installation Date: <input type="date" name="install_date" value="2000-01-01" class="form-control"><br>
          <select name="ssi_install" class="form-control" required>
            <option value="0" disabled selected>Installed by SSI?</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
          <br>

          <select name="ssi_test_acct" class="form-control" required>
            <option value="0" disabled selected>Tests by SSI?</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
          <br>

          <textarea name="notes" class="form-control" placeholder="System Notes" rows="4"></textarea><br>

          <br>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>

      </div>
    </div>
  </div>
</div>

<!-- add Deficiency Modal -->
<div class="modal fade" id="addSystemModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add System</h5>
      </div>
      <div class="modal-body">

        <form action="/site/{{ $site->id }}/create" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">

          Name: <input type="text" name="name" value="" class="form-control"><br>
          Type: <select name="type" class="form-control">
              <option value="0">Select System Type</option>
            @foreach ($system_types as $system_type)
              <option value="{{ $system_type->id }}">{{ $system_type->type }}</option>
            @endforeach
          </select><br>
          Installation Date: <input type="date" name="install_date" value="" class="form-control"><br>
          Installed by SSI: <select name="ssi_install" class="form-control">
            <option value="0">...</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select><br>
          Tests & Inspections by SSI: <select name="ssi_test_acct" class="form-control">
            <option value="0">...</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>

          <br>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>

      </div>
    </div>
  </div>
</div>

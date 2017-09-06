<!-- edit Site Modal -->
<div
  class="modal fade"
  id="updateSiteModal"
  role="dialog"
  tabindex='-1'>
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Site</h5>
      </div>
      <div class="modal-body">

        <form action="/sites/{{ $site->id }}" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="put">

        <div class="form-group">

          Site Name: <input type="text" name="name" value="{{ $site->name }}" class="form-control"><br>
          Address: <input type="text" name="address1" value="{{ $site->address1 }}" class="form-control"><br>
          Address: <input type="text" name="address2" value="{{ $site->address2 }}" class="form-control"><br>
          City: <input type="text" name="city" value="{{ $site->city }}" class="form-control"><br>
          State:  <select name="state_id" class="form-control">
              <option value="{{ $site->state_id }}" selected>{{ $site->state->state }}</option>
            @foreach($states as $state)
              <option value="{{ $state->id }}">{{ $state->state }}</option>
            @endforeach
          </select><br>
          Zip Code: <input type="text" name="zip" value="{{ $site->zip }}" class="form-control"><br>
          Serviced From:  <select required name="branch_office_id" class="form-control">
            <option value="{{ $site->branch_office_id }}" selected>{{ $site->branchOffice->name }}</option>
            @foreach($branchOffices as $branch)
              <option value="{{ $branch->id }}">{{ $branch->name }}</option>
            @endforeach
          </select><br>
          Latitude: <input type="text" id="lat" name="lat" value="{{ $site->lat }}" class="form-control"><br>
          Longitude: <input type="text" id="lon" name="lon" value="{{ $site->lon }}" class="form-control"><br>
          Phone: <input type="text" name="phone" value="{{ $site->phone }}" class="form-control"><br>
          Fax: <input type="text" name="fax" value="{{ $site->fax }}" class="form-control"><br>
          Notes: <textarea name="notes" rows="5" class="form-control">{{ $site->notes }}</textarea><br>

          <br>
          <button type="submit" class="btn btn-default">Update</button>
        </div>
      </form>

      </div>
    </div>
  </div>
</div>

<!-- add Deficiency Modal -->
<div class="modal fade" id="addSiteModal" role="dialog" tabindex='-1'>
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add Site</h5>
      </div>
      <div class="modal-body">

        <form action="/customers/{{ $customer->id }}/site/create" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">

          Site Name: <input required type="text" name="name" value="" class="form-control"><br>
          Address: <input required type="text" name="address1" value="" class="form-control"><br>
          Address: <input type="text" name="address2" value="" class="form-control"><br>
          City: <input required type="text" name="city" value="" class="form-control"><br>
          State:  <select required name="state_id" class="form-control">
            <option value="" disabled selected>Select a State</option>
            @foreach($states as $state)
              <option value="{{ $state->id }}">{{ $state->state }}</option>
            @endforeach
          </select><br>
          Zip Code: <input required type="text" name="zip" value="" class="form-control"><br>
          Serviced From:  <select required name="branch_office_id" class="form-control">
            <option value="" disabled selected>Select a Branch Office</option>
            @foreach($branchOffices as $branch)
              <option value="{{ $branch->id }}">{{ $branch->name }}</option>
            @endforeach
          </select><br>
          Latitude: <input required type="text" id="lat" name="lat" value="" placeholder="45.0000" class="form-control"><br>
          Longitude: <input required type="text" id="lon" name="lon" value="" placeholder="-125.0000" class="form-control"><br>
          Phone: <input type="text" name="phone" value="" placeholder="XXX-XXX-XXXX" class="form-control"><br>
          Fax: <input type="text" name="fax" value="" class="form-control"><br>
          Notes: <textarea name="notes" class="form-control"></textarea><br>


          <br>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>

      </div>
    </div>
  </div>
</div>

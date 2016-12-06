<!-- add Deficiency Modal -->
<div class="modal fade" id="addSiteModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add Site</h5>
      </div>
      <div class="modal-body">

        <form action="/customer/{{ $customer->id }}/site/create" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">

          Site Name: <input type="text" name="name" value="" class="form-control"><br>
          Address: <input type="text" name="address1" value="" class="form-control"><br>
          Address: <input type="text" name="address2" value="" class="form-control"><br>
          City: <input type="text" name="city" value="" class="form-control"><br>
          State:  <select name="state_id" class="form-control">
            @foreach($states as $state)
              <option value="{{ $state->id }}">{{ $state->state }}</option>
            @endforeach
          </select><br>
          Zip Code: <input type="text" name="zip" value="" class="form-control"><br>
          Latitude: <input type="text" id="lat" name="lat" value="" class="form-control"><br>
          Longitude: <input type="text" id="lon" name="lon" value="" class="form-control"><br>
          Phone: <input type="text" name="phone" value="" class="form-control"><br>
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

<script src="{{ URL::asset('js/add_site_form.js') }}"></script>

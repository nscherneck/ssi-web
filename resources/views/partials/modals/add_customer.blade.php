<!-- add Customer Modal -->
<div class="modal fade" id="addCustomerModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" tabindex="-1">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add Customer</h5>
      </div>
      <div class="modal-body">

        <form action="/customers" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group row">
            <div class="col-sm-12">
              <input required name="name" type="text" value="" class="form-control form-control-sm" id="smFormGroupInput" title="Customer Name" placeholder="Customer Name">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12">
              <input required name="address1" type="text" value="" class="form-control form-control-sm" id="smFormGroupInput" title="Address" placeholder="Address">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12">
              <input name="address2" type="text" value="" class="form-control form-control-sm" id="smFormGroupInput" title="Address" placeholder="Address">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12">
              <input name="address3" type="text" value="" class="form-control form-control-sm" id="smFormGroupInput" title="Address" placeholder="Address">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12">
              <input required name="city" type="text" value="" class="form-control" title="City" placeholder="City">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12">
              <select  required name="state_id" class="form-control input-group mb-2 mr-sm-2 mb-sm-0">
                @foreach($states as $state)
                  <option value="{{ $state->id }}">{{ $state->state }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12">
              <input required name="zip" type="text" value="" class="form-control" title="Zip" placeholder="Zip">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12">
              <label class="sr-only" for="inlineFormInput">Phone</label>
              <input name="phone" type="tel" value="" class="form-control input-group" id="inlineFormInput" title="Phone" placeholder="Phone">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12">
              <label class="sr-only" for="inlineFormInput">Fax</label>
              <input name="fax" type="tel" value="" class="form-control" title="Fax" placeholder="Fax">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12">
              <label class="sr-only" for="inlineFormInput">Website</label>
              <input name="web" type="url" value="" class="form-control input-group" id="inlineFormInput" placeholder="http://www.example.com">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12">
              <label class="sr-only" for="inlineFormInput">Email</label>
              <input name="email" type="email" value="" class="form-control" title="Email" placeholder="john@doe.com">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12">
              <textarea name="notes" class="form-control" title="Notes" placeholder="Notes"></textarea><br>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Create Customer</button>
          </div>

      </form>

      </div>
    </div>
  </div>
</div>

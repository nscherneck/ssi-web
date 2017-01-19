<!-- edit Deficiency Modal -->
<div class="modal fade" id="updateManufacturerModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Manufacturer</h5>
      </div>

      <div class="modal-body">


        <div class="form-group">

          <form action="/manufacturers/{{ $manufacturer->id }}" method="POST">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="put">


            Name:  <input  name="name" type="text" value="{{ $manufacturer->name }}" class="form-control"><br>
            Address:  <input  name="address1" type="text" value="{{ $manufacturer->address1 }}" class="form-control"><br>
            Address:  <input  name="address2" type="text" value="{{ $manufacturer->address2 }}" class="form-control"><br>
            City:  <input  name="city" type="text" value="{{ $manufacturer->city }}" class="form-control"><br>
            State:  <select name="state_id" class="form-control">
                @if($manufacturer->state_id)<option value="{{ $manufacturer->state_id }}">{{ $manufacturer->state->state }}</option>@endif
              @foreach($states as $state)
                <option value="{{ $state->id }}">{{ $state->state }}</option>
              @endforeach
            </select><br>
            Zip:  <input  name="zip" type="text" value="{{ $manufacturer->zip }}" class="form-control"><br>
            Phone:  <input  name="phone" type="text" value="{{ $manufacturer->phone }}" class="form-control"><br>
            Fax:  <input  name="fax" type="text" value="{{ $manufacturer->fax }}" class="form-control"><br>
            Website:  <input  name="web" type="text" value="{{ $manufacturer->web }}" class="form-control"><br>
            Distributor Website:  <input  name="distributor_login" type="text" value="{{ $manufacturer->distributor_login }}" class="form-control"><br>
            Email:  <input  name="email" type="text" value="{{ $manufacturer->email }}" class="form-control"><br>
            Notes:  <textarea  name="notes" class="form-control">{{ $manufacturer->notes }}</textarea>

            <div class="modal-footer">

              <button type="submit" class="btn btn-default">Update</button>

            </div>

          </form>

        </div>


      </div>
    </div>
  </div>
</div>

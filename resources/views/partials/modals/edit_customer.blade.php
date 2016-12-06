<!-- edit Deficiency Modal -->
<div class="modal fade" id="updateCustomerModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Customer</h5>
      </div>

      <div class="modal-body">


        <div class="form-group">

          <form action="/customer/{{ $customer->id }}/update" method="POST">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="put">


            Name:  <input  name="name" type="text" value="{{ $customer->name }}" class="form-control"><br>
            Address:  <input  name="address1" type="text" value="{{ $customer->address1 }}" class="form-control"><br>
            Address:  <input  name="address2" type="text" value="{{ $customer->address2 }}" class="form-control"><br>
            Address:  <input  name="address3" type="text" value="{{ $customer->address3 }}" class="form-control"><br>
            City:  <input  name="city" type="text" value="{{ $customer->city }}" class="form-control"><br>
            State:  <select name="state_id" class="form-control">
                <option value="{{ $customer->state->id }}">{{ $customer->state->state }}</option>
              @foreach($states as $state)
                <option value="{{ $state->id }}">{{ $state->state }}</option>
              @endforeach
            </select><br>
            Zip:  <input  name="zip" type="text" value="{{ $customer->zip }}" class="form-control"><br>
            Phone:  <input  name="phone" type="text" value="{{ $customer->phone }}" class="form-control"><br>
            Fax:  <input  name="fax" type="text" value="{{ $customer->fax }}" class="form-control"><br>
            Website:  <input  name="web" type="text" value="{{ $customer->web }}" class="form-control"><br>
            Email:  <input  name="email" type="text" value="{{ $customer->email }}" class="form-control"><br>
            Notes:  <textarea  name="notes" class="form-control">{{ $customer->notes }}</textarea><br>

            <button type="submit" class="btn btn-default">Update</button>

          </form>

        </div>


      </div>
    </div>
  </div>
</div>

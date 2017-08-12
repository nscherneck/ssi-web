<!-- delete Customer Modal -->
<div
  class="modal fade"
  id="deleteCustomerModal"
  role="dialog"
  tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body text-center">

        <p>
          <span>
            <div class="modal-icon">
              @include('partials.icons.caution-icon')
            </div>
            <h4>Are you sure?</h4>
            <br>
          </span>
          <span>Note: You won't be able to delete a Customer that contains Sites.</span>
        </p>

          <form action="/customer/{{ $customer->id }}/delete" method="post" accept-charset="UTF-8">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="delete">

            <br>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>

      </div>


      </div>
    </div>
  </div>

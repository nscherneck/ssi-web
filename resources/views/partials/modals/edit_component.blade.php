<!-- edit Component Modal -->
<div
  class="modal fade"
  id="updateComponentModal"
  role="dialog"
  tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Component</h5>
      </div>
      <div class="modal-body">

        <form action="/component/{{ $component->id }}" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="put">

        <div class="form-group">

          <div class="form-group row">
            <label for="model" class="col-sm-2 col-form-label">Model:</label>
            <div class="col-sm-10">
              <input type="text" name="model" value="{{ $component->model }}" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Description:</label>
            <div class="col-sm-10">
              <textarea name="description" class="form-control no-resize" rows=6>{{ $component->description }}</textarea>
            </div>
          </div>

          <div class="form-group row">
            <label for="discontinued" class="col-sm-2 col-form-label">Category:</label>
            <div class="col-sm-10">
              <select name="component_category_id" class="form-control">
                  <option value="{{ $component->componentCategory->id }}">{{ $component->componentCategory->name }}</option>
                  @foreach ($componentCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="discontinued" class="col-sm-2 col-form-label">Discontinued:</label>
            <div class="col-sm-10">
              <select name="discontinued" class="form-control">
                  <option value="{{ $component->discontinued }}">@if ($component->discontinued === 1) Yes @else No @endif</option>
                  <option value="@if($component->discontinued === 1) 0 @else 1 @endif">@if($component->discontinued === 1) No @else Yes @endif</option>
              </select>
            </div>
          </div>
          
          <div class="form-group row">
            <label for="notes" class="col-sm-2 col-form-label">Notes:</label>
            <div class="col-sm-10">
              <textarea name="notes" class="form-control no-resize" rows=6 style=>{{ $component->notes }}</textarea>
            </div>
          </div>

          <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
              <button type="submit" class="btn btn-default">Update</button>
            </div>
          </div>

        </div>
      </form>

      </div>
    </div>
  </div>
</div>

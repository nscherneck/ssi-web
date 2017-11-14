<h4>Create Component</h4>
<hr>

<form action="/manufacturers/{{ $manufacturer->id }}/component" method="POST">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">

  <div class="row">
    
    <div class="col-lg-6">
      <input type="text" name="model" class="form-control" placeholder="Model Number" 
      value="{{ old('model') }}" autocomplete="off" required>
      <br>
    </div>
    
    <div class="col-lg-6">
      <select name="component_category_id" class="form-control" required>
        <option value="">Select Category</option>
        @foreach ($componentCategories as $category)
          @if (old('component_category_id') == $category->id)
            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
          @else
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endif
        @endforeach
      </select>
      <br>
    </div>
    
  </div>
  
  <textarea 
    name="description" class="form-control no-resize" 
    placeholder="Description" rows="8" autocomplete="off" required>{{ old('description') }}</textarea>
  <br>
  
  <textarea 
    name="notes" class="form-control no-resize" 
    placeholder="Notes" rows="6" autocomplete="off">{{ old('notes') }}</textarea>
  
  <div class="checkbox">
    <label>
      <input type="checkbox" name="discontinued" value="1"
      @if(old('discontinued')) checked @endif>
      Discontinued?
    </label>
  </div>

  <button type="submit" class="btn btn-primary">Create</button><br><br>
  
  @if(count($errors))
    @foreach($errors->all() as $error)
      <p style="color: crimson;">{{ $error }}</p>
    @endforeach
  @endif

  </div>
</form>

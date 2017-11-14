@extends('admin.home')

@section('admin-title')
    Manage System Types
@endsection

@section('admin-content')

<form class="form-inline" method="POST" action="/admin/systemtypes">
  {{ csrf_field() }}
  <div class="row">
      <div class="col-lg-6">
          <div class="form-group">
            <input type="text" class="form-control" name="type"
            placeholder="i.e. Create System Type" autocomplete="off" value="{{ old('type') }}">
          </div>
          <button type="submit" class="btn btn-primary">Create</button>
          @if ($errors->has('type'))
              <span class="help-block">
                  <strong>{{ $errors->first('type') }}</strong>
              </span>
          @endif
      </div>
  </div>
</form>

<hr>

@foreach($systemTypes->chunk(4) as $chunk)
<div class="row">
  @foreach($chunk as $systemType)
    <div class="col-lg-3">
      <div class="panel panel-default">
        <div class="panel-body text-center">
          <h6>
            {{ $systemType->type }}
          </h6>
          <p>
            @include('partials.icons.system-icon')
            Systems ({{ $systemType->systems->count() }})
          </p>
        </div>
      </div>
    </div>
  @endforeach
</div>
@endforeach

@endsection

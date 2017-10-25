@extends('admin.home')

@section('admin-title')
    Manage Roles
@endsection

@section('admin-content')

<form class="form-inline" method="POST" action="/admin/roles">
  {{ csrf_field() }}
  <div class="row">
      <div class="col-lg-6">
          <div class="form-group">
            <input type="text" class="form-control" name="name"
            placeholder="i.e. Administrator" autocomplete="off" value="{{ old('name') }}">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
          @if ($errors->has('name'))
              <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif
      </div>
  </div>
</form>

<hr>
@foreach($roles->chunk(4) as $chunk)
<div class="row">
  @foreach($chunk as $role)
    <div class="col-lg-3">
      <div class="panel panel-default">
        <div class="panel-body text-center">
          <h6>
            <a href="/admin/roles/{{ $role->id }}">
              <h4>{{ $role->name }}</h4>
            </a>
          </h6>
        </div>
      </div>
    </div>
  @endforeach
</div>
@endforeach

@endsection

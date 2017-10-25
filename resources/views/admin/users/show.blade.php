@extends('admin.home')

@section('admin-title')
  {{ $user->full_name }}
@endsection

@section('admin-content')
  <div class="row">
    <div class="col-lg-6 col-lg-offset-3">
      <div class="panel panel-default">
        <div class="panel-body">
          <form>
            <div class="form-group">
              <label for="first_name">First Name</label>
              <input type="email" class="form-control" name="first_name"
              placeholder="Email" value="{{ $user->first_name }}" disabled>
            </div>
            <div class="form-group">
              <label for="last_name">Last Name</label>
              <input type="email" class="form-control" name="last_name"
              placeholder="Email" value="{{ $user->last_name }}" disabled>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email"
              placeholder="Email" value="{{ $user->email }}" disabled>
            </div>
            <div class="row">
              <div class="col-lg-6 text-center">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" {{ $user->is_service_technician ? 'checked' : '' }} disabled> Service Technician
                  </label>
                </div>
              </div>
              <div class="col-lg-6 text-center">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" {{ $user->is_installation_technician ? 'checked' : '' }} disabled> Install Technician
                  </label>
                </div> <!-- ./checkbox -->
              </div> <!-- ./column -->
            </div> <!-- ./row -->
          </form>
          <hr>
          <h5>Role Assigned:
            @foreach ($user->roles as $role)
              <a href="/admin/roles/{{ $role->id }}">
                <strong>
                  {{ $role->name }}
                </strong>
              </a>
              @if (!$loop->last)
                  |
              @endif
            @endforeach
          </h5>
        </div> <!-- ./panel-body -->
      </div> <!-- ./panel -->
    </div> <!-- ./column -->
  </div> <!-- ./row -->
@endsection

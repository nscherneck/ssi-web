@extends('admin.home')

@section('admin-title')
  Role: {{ $role->name }}
@endsection

@section('admin-content')
  <div class="row">
    <div class="col-lg-6 col-lg-offset-3">

      <div>
          <h4>Users Assigned This Role ({{ $role->users->count() }})</h4>
      </div>

      <form class="form-group" method="POST" action="/admin/roleuser/{{ $role->id }}">
        {{ csrf_field() }}
        <select class="form-control" id="user_id" name="user_id">
          <option>Add a User</option>
          @foreach ($users as $user)
            <option value="{{ $user->id }}">
                {{ $user->full_name }}
            </option>
          @endforeach
        </select>
        <br>
        <button type="submit"
          class="btn btn-primary btn-sm">
          Add User
        </button>
      </form>

      @forelse ($assignedUsers as $assignedUser)
        <div class="panel panel-default">
          <div class="panel-body text-center">
            <a href="/admin/users/{{ $assignedUser->id }}">
              <h5>{{ $assignedUser->full_name }}</h5>
            </a>
          </div> <!-- ./panel-body -->
        </div> <!-- ./panel -->
      @empty
        <br>
        <em><small>No users have been assigned this role.</small></em>
        <hr>
      @endforelse
      <hr>

      <div>
          <h4>Attached Permissions ({{ $role->permissions->count() }})</h4>
      </div>
      <form class="form-group" method="POST" action="/admin/permissionrole/{{ $role->id }}">
        {{ csrf_field() }}
        <select class="form-control" id="permission_id" name="permission_id">
          <option>Attach a Permission</option>
          @foreach ($permissions as $permission)
            <option value="{{ $permission->id }}">
                {{ $permission->name }}
            </option>
          @endforeach
        </select>
        <br>
        <button type="submit"
          class="btn btn-primary btn-sm">
          Attach Permission
        </button>
      </form>
      <hr>
      @forelse ($attachedPermissions->chunk(2) as $chunk)
        <div class="row">
          @foreach ($chunk as $attachedPermission)
            <div class="col-lg-6">
              <div class="panel panel-default">
                <div class="panel-body text-center">
                    <h5>{{ $attachedPermission->name }}</h5>
                </div> <!-- ./panel-body -->
              </div> <!-- ./panel -->
            </div> <!-- ./column -->
          @endforeach
        </div> <!-- ./row -->
      @empty
        <br>
        <em>
          <small>
            No permissions have been attached to this role.
          </small>
        </em>
        <hr>
      @endforelse

    </div> <!-- ./column -->
  </div> <!-- ./row -->
@endsection

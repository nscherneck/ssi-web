@extends('admin.home')

@section('admin-title')
    Manage Users
@endsection

@section('admin-content')

  <table class="table">
    <thead>
        <tr>
            <th>
                Name
            </th>
            <th>
                Email
            </th>
            <th class="text-center">
                Service Technician
            </th>
            <th class="text-center">
                Installation
            </th>
            <th class="text-center">
                Last Login
            </th>
            <th class="text-center">
                User Since
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>
                    <small>
                        <a href="/admin/users/{{ $user->id }}">
                          {{ $user->full_name }}
                        </a>
                    </small>
                </td>
                <td>
                    <small>
                        {{ $user->email }}
                    </small>
                </td>
                <td class="text-center">
                    <small>
                        {{ $user->is_service_technician ? '&#10003;' : ''}}
                    </small>
                </td>
                <td class="text-center">
                    <small>
                        {{ $user->is_installation_technician ? '&#10003;' : ''}}
                    </small>
                </td>
                <td class="text-center">
                    <small>
                        @if($user->last_login)
                            {{ $user->last_login->diffForHumans() }}
                        @endif
                    </small>
                </td>
                <td class="text-center">
                    <small>
                        @if($user->created_at)
                            {{ $user->created_at->format('F j, Y') }}
                        @endif
                    </small>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>

<hr>

<h4>Add User</h4>
<hr>
<form class="form-horizontal" method="POST" action="/admin/users">
  {{ csrf_field() }}
  <div class="row">
      <div class="col-lg-6">
          <div class="form-group">
            <label for="first_name" class="col-lg-3 control-label">First Name</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="first_name" placeholder="" autocomplete="off" value="{{ old('first_name') }}">
            </div>
          </div>
      </div> <!-- ./column -->
      <div class="col-lg-6">
        <div class="form-group">
          <label for="last_name" class="col-lg-3 control-label">Last Name</label>
          <div class="col-lg-9">
              <input type="text" class="form-control" name="last_name" placeholder="" autocomplete="off" value="{{ old('last_name') }}">
          </div>
        </div>
      </div> <!-- ./column -->
  </div> <!-- ./row -->
  <div class="row">
      <div class="col-lg-6">
          <div class="form-group">
            <label for="email" class="col-lg-3 control-label">Email</label>
            <div class="col-lg-9">
                <input type="email" class="form-control" name="email" placeholder="" autocomplete="off" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
          </div>
      </div> <!-- ./column -->
      <div class="col-lg-6">
        <div class="form-group">
          <label for="email_confirmation" class="col-lg-3 control-label">Confirm Email</label>
          <div class="col-lg-9">
              <input type="email" class="form-control" name="email_confirmation" placeholder="" autocomplete="off" value="{{ old('email_confirmation') }}">
              @if ($errors->has('email_confirmation'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email_confirmation') }}</strong>
                  </span>
              @endif
          </div>
        </div>
      </div> <!-- ./column -->
  </div> <!-- ./row -->
  <div class="row">
      <div class="col-lg-6">
          <div class="form-group">
            <label for="password" class="col-lg-3 control-label">Password</label>
            <div class="col-lg-9">
                <input type="password" class="form-control" name="password"
                placeholder="Password must be minimum 6 characters." autocomplete="off">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
          </div>
      </div> <!-- ./column -->
      <div class="col-lg-6">
        <div class="form-group">
          <label for="password_confirmation" class="col-lg-3 control-label">Re-enter Password</label>
          <div class="col-lg-9">
              <input type="password" class="form-control" name="password_confirmation"
              placeholder="Please re-enter your password" autocomplete="off">
              @if ($errors->has('password_confirmation'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                  </span>
              @endif
          </div>
        </div>
      </div> <!-- ./column -->
  </div> <!-- ./row -->

  <div class="checkbox">
    <label>
      <input type="checkbox" name="is_service_technician" value="1" checked> Service Technician
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="is_installation_technician" value="1" checked> Installation Technician
    </label>
  </div>
  <br>
  <div class="form-group">
      <button type="submit" class="btn btn-default">Submit</button>
  </div>

</form>
@endsection

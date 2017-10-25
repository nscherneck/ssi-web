@extends('admin.home')

@section('admin-title')
    Manage Branch Offices
@endsection

@section('admin-content')

  <table class="table">
    <thead>
        <tr>
            <th>
                Office
            </th>
            <th>
                Address
            </th>
            <th>
                Address
            </th>
            <th>
                City
            </th>
            <th>
                State
            </th>
            <th>
                Zip
            </th>
            <th>
                Phone
            </th>
            <th>
                Fax
            </th>
            <th>
                Latitude
            </th>
            <th>
                Longitude
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($branchoffices as $office)
            <tr>
                <td>
                    <small>
                        {{ $office->name }}
                    </small>
                </td>
                <td>
                    <small>
                        {{ $office->address1 }}
                    </small>
                </td>
                <td>
                    <small>
                        {{ $office->address2 }}
                    </small>
                </td>
                <td>
                    <small>
                        {{ $office->city }}
                    </small>
                </td>
                <td>
                    <small>
                        {{ $office->state->state }}
                    </small>
                </td>
                <td>
                    <small>
                        {{ $office->zip }}
                    </small>
                </td>
                <td>
                    <small>
                        {{ $office->phone }}
                    </small>
                </td>
                <td>
                    <small>
                        {{ $office->fax }}
                    </small>
                </td>
                <td>
                    <small>
                        {{ $office->latitude }}
                    </small>
                </td>
                <td>
                    <small>
                        {{ $office->longitude }}
                    </small>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>

<hr>

<h4>Add Branch Office</h4>
<hr>
<form class="form-horizontal" method="POST" action="/admin/branchoffices">
  {{ csrf_field() }}
  <div class="row">
      <div class="col-lg-6">
          <div class="form-group">
            <label for="name" class="col-lg-3 control-label">Office Name</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="name" placeholder="" autocomplete="off" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
          </div>
      </div> <!-- ./column -->
      <div class="col-lg-6">
      </div> <!-- ./column -->
  </div> <!-- ./row -->
  <div class="row">
      <div class="col-lg-6">
          <div class="form-group">
            <label for="text" class="col-lg-3 control-label">Address</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="address1"
                placeholder="12345 Main Street" autocomplete="off" value="{{ old('address1') }}">
            </div>
          </div>
      </div> <!-- ./column -->
      <div class="col-lg-6">
        <div class="form-group">
          <label for="address2" class="col-lg-3 control-label">Address</label>
          <div class="col-lg-9">
              <input type="text" class="form-control" name="address2"
              placeholder="Suite A" autocomplete="off" value="{{ old('address2') }}">
          </div>
        </div>
      </div> <!-- ./column -->
  </div> <!-- ./row -->
  <div class="row">
      <div class="col-lg-6">
          <div class="form-group">
            <label for="city" class="col-lg-3 control-label">City</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="city"
                placeholder="" autocomplete="off" value="{{ old('city') }}">
            </div>
          </div>
      </div> <!-- ./column -->
      <div class="col-lg-6">
        <div class="form-group">
          <label for="state" class="col-lg-3 control-label">State</label>
          <div class="col-lg-9">
              <select class="form-control" id="state" name="state">
                @foreach($states as $state)
                  <option value="{{ $state->id }}">
                    {{ $state->state }}
                  </option>
                @endforeach
              </select>
          </div>
        </div>
      </div> <!-- ./column -->
  </div> <!-- ./row -->
  <div class="row">
      <div class="col-lg-6">
          <div class="form-group">
            <label for="zip" class="col-lg-3 control-label">Zip</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="zip"
                placeholder="" autocomplete="off" value="{{ old('zip') }}">
            </div>
          </div>
      </div> <!-- ./column -->
      <div class="col-lg-6">
      </div> <!-- ./column -->
  </div> <!-- ./row -->
  <div class="row">
      <div class="col-lg-6">
          <div class="form-group">
            <label for="phone" class="col-lg-3 control-label">Phone</label>
            <div class="col-lg-9">
                <input type="telephone" class="form-control" name="phone"
                placeholder="" autocomplete="off" value="{{ old('phone') }}">
            </div>
          </div>
      </div> <!-- ./column -->
      <div class="col-lg-6">
        <div class="form-group">
          <label for="fax" class="col-lg-3 control-label">Fax</label>
          <div class="col-lg-9">
              <input type="text" class="form-control" name="fax"
              placeholder="" autocomplete="off" value="{{ old('fax') }}">
          </div>
        </div>
      </div> <!-- ./column -->
  </div> <!-- ./row -->
  <div class="row">
      <div class="col-lg-6">
          <div class="form-group">
            <label for="latitude" class="col-lg-3 control-label">Latitude</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="latitude"
                placeholder="45.123456" autocomplete="off" value="{{ old('latitude') }}">
                @if ($errors->has('latitude'))
                    <span class="help-block">
                        <strong>{{ $errors->first('latitude') }}</strong>
                    </span>
                @endif
            </div>
          </div>
      </div> <!-- ./column -->
      <div class="col-lg-6">
        <div class="form-group">
          <label for="longitude" class="col-lg-3 control-label">Longitude</label>
          <div class="col-lg-9">
              <input type="text" class="form-control" name="longitude"
              placeholder="-125.123456" autocomplete="off" value="{{ old('longitude') }}">
              @if ($errors->has('longitude'))
                  <span class="help-block">
                      <strong>{{ $errors->first('longitude') }}</strong>
                  </span>
              @endif
          </div>
        </div>
      </div> <!-- ./column -->
  </div> <!-- ./row -->

  <div class="form-group">
      <button type="submit" class="btn btn-default">Submit</button>
  </div>

</form>
@endsection

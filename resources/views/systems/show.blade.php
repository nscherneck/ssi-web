@extends('layout')

@section('title', 'SSI-Extranet | System Record')

@section('content')

@include('partials.nav')

<div class="container-fluid">

  @include('partials.flash')

  <br>
  <ol class="breadcrumb small">
    <li><a href="/customers">Customers</a></li>
    <li><a href="/customer/{{ $system->site->customer->id }}">
    {{ $system->site->customer->name }}</a></li>
    <li><a href="/site/{{ $system->site->id }}">{{ $system->site->name }}</a></li>
    <li>{{ $system->name }}</li>
  </ol>

<!--          LEFT SIDE CONTENT         -->

<div class="row">

  <div class="col-md-3 no-gutter-right">

    <div class="panel panel-primary text-center">
      <div class="panel-heading"><h4>{{ $system->name }}</h4></div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">System Info</div>
      <div class="panel-body">
        <p>
          <small>
            <strong>System Type:</strong> {{ $system->system_type->type }}<br>
            <strong>Installation Date:</strong> {{ $system->install_date->format('F d, Y') }}<br>
            <hr>
            <strong>Installed by SSI:</strong>@if ($system->ssi_install == 1) Yes @else No @endif<br>
            <strong>Testing by SSI:</strong>@if ($system->ssi_test_acct == 1) Yes @else No @endif<br>
          </small>
        </p>
      </div>
    </div>

    @if ($system->next_test_date)
    <div class="panel panel-danger">
      <div class="panel-body text-center">
        <p>
          <strong>Next Test Due:</strong> {{ $system->next_test_date->format('F Y') }}

          <hr>

      <div class="text-center">
          <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateNextTestDateModal">
            <i class="fa fa-cog"></i></button>
          <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#nullifyNextTestDateModal">
            <i class="fa fa-trash-o"></i></button>
        </p>
      </div>

      </div>
    </div>
    @endif

    <div class="panel panel-primary">
      <div class="panel-body">
        <p>
          <small>
            <strong>Added:</strong> {{ $system->formatted_created_at }}<br>
            <strong>Added By:</strong> {{ $system->addedBy->full_name }}<br>
            @if ($system->updated_by)
            <hr>
            <strong>Edited:</strong> {{ $system->formatted_updated_at }}<br>
            <strong>Edited By:</strong> {{ $system->updatedBy->full_name }}<br>
            @endif
          </small>
        </p>
      </div>
    </div>

    @if ($system->notes)
    <div class="panel panel-primary">
    <div class="panel-heading">Notes</div>
    <div class="panel-body">
      <small>
      {!! nl2br(e($system->notes)) !!}
      </small>
    </div>
    </div>
    @endif

    <div class="text-center">

      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateSystemModal">
        <i class="fa fa-cog"></i></button>
      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#deleteSystemModal">
        <i class="fa fa-trash-o"></i></button>
      <br><br>

    </div>

  </div>

<!--          RIGHT SIDE CONTENT         -->

<div class="col-md-9">

  <div class="titleBar" style="margin-top: 0">
    <p>Components ({{ $system->components()->count() }})</p>
  </div>

    <h5>Detection & Controls</h5>

    <div class="table-responsive">

      <table class="table table-hover table-condensed">
        <thead>
          <tr class="info">
            <th><small>Quantity</small></th>
            <th><small>Name</small></th>
            <th><small>Manufacturer</small></th>
            <th><small>Model</small></th>
            <th><small>Description</small></th>
            <th><small>Category</small></th>
            <th><small>Discontinued?</small></th>
            <th></th>
          </tr>
        </thead>
        <tbody>

          @foreach($system->getComponent(1) as $panel)
            <tr>
              <td width="5%"><small>
              {{ $panel->pivot->quantity }}
              </small></td>

              <td width="15%"><small>
              {{ $panel->pivot->name }}
              </small></td>

              <td width="10%"><small>
              <a href="/manufacturer/{{ $panel->manufacturer->id }}">
              {{ $panel->manufacturer->name }}
              </a>
              </small></td>

              <td width="10%"><small>
              <a href="/component/{{ $panel->id }}">
              {{ $panel->model }}
              </a>
              </small></td>

              <td width="30%">
              <small>
                {{ $panel->formatted_description }}
              </small>
              </td>

              <td width="15%">
              <small>{{ $panel->component_category->name }}</small>
              </td>

              <td width="10%">
              <small>{{ $panel->formatted_discontinued }}</small>
              </td>

              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $panel->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->getComponent(14) as $modularpanel)
            <tr>
              <td width="5%"><small>
              {{ $modularpanel->pivot->quantity }}
              </small></td>

              <td width="15%"><small>
              {{ $modularpanel->pivot->name }}
              </small></td>

              <td width="10%"><small>
              <a href="/manufacturer/{{ $modularpanel->manufacturer->id }}">
              {{ $modularpanel->manufacturer->name }}
              </a>
              </small></td>

              <td width="10%"><small>
              <a href="/component/{{ $modularpanel->id }}">
              {{ $modularpanel->model }}
              </a>
              </small></td>

              <td width="30%"><small>
              {{ $panel->formatted_description }}
              </small></td>

              <td width="15%">
              <small>{{ $modularpanel->component_category->name }}</small>
              </td>

              <td width="10%">
              <small>{{ $modularpanel->formatted_discontinued }}</small>
              </td>

              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $modularpanel->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->getComponent(2) as $controlequipment)
            <tr>
              <td width="5%"><small>
              {{ $controlequipment->pivot->quantity }}
              </small></td>

              <td width="15%"><small>
              {{ $controlequipment->pivot->name }}
              </small></td>

              <td width="10%"><small>
              <a href="/manufacturer/{{ $controlequipment->manufacturer->id }}">
              {{ $controlequipment->manufacturer->name }}
              </a>
              </small></td>

              <td width="10%"><small>
              <a href="/component/{{ $controlequipment->id }}">
              {{ $controlequipment->model }}
              </a>
              </small></td>

              <td width="30%"><small>
              {{ $controlequipment->formatted_description }}
              </small></td>

              <td width="15%"><small>
              {{ $controlequipment->component_category->name }}
              </small></td>

              <td width="10%"><small>
              {{ $controlequipment->formatted_discontinued }}
              </small></td>

              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $controlequipment->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->getComponent(13) as $airsamplingdetection)
            <tr>
              <td width="5%"><small>
              {{ $airsamplingdetection->pivot->quantity }}
              </small></td>

              <td width="15%"><small>
              {{ $airsamplingdetection->pivot->name }}
              </small></td>

              <td width="10%"><small>
              <a href="/manufacturer/{{ $airsamplingdetection->manufacturer->id }}">
              {{ $airsamplingdetection->manufacturer->name }}
              </a>
              </small></td>

              <td width="10%"><small>
              <a href="/component/{{ $airsamplingdetection->id }}">
              {{ $airsamplingdetection->model }}
              </a>
              </small></td>

              <td width="30%"><small>
              {{ $airsamplingdetection->formatted_description }}
              </small></td>

              <td width="15%"><small>
              {{ $airsamplingdetection->component_category->name }}
              </small></td>

              <td width="10%"><small>
              {{ $airsamplingdetection->formatted_discontinued }}
              </small></td>

              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $airsamplingdetection->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->getComponent(3) as $detection)
            <tr>
              <td width="5%"><small>
              {{ $detection->pivot->quantity }}
              </small></td>

              <td width="15%"><small>
              {{ $detection->pivot->name }}
              </small></td>

              <td width="10%"><small>
              <a href="/manufacturer/{{ $detection->manufacturer->id }}">
              {{ $detection->manufacturer->name }}
              </a>
              </small></td>

              <td width="10%"><small>
              <a href="/component/{{ $detection->id }}">
              {{ $detection->model }}
              </a>
              </small></td>

              <td width="30%"><small>
              {{ $detection->formatted_description }}
              </small></td>

              <td width="15%"><small>
              {{ $detection->component_category->name }}
              </small></td>

              <td width="10%"><small>
              {{ $detection->formatted_discontinued }}
              </small></td>

              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $detection->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->getComponent(4) as $notification)
            <tr>
              <td><small>
              {{ $notification->pivot->quantity }}
              </small></td>

              <td><small>
              {{ $notification->pivot->name }}
              </small></td>

              <td><small>
              <a href="/manufacturer/{{ $notification->manufacturer->id }}">
              {{ $notification->manufacturer->name }}
              </a>
              </small></td>

              <td><small>
              <a href="/component/{{ $notification->id }}">
              {{ $notification->model }}
              </a>
              </small></td>

              <td width="30%"><small>
              {{ $notification->formatted_description }}
              </small></td>

              <td><small>
              {{ $notification->component_category->name }}
              </small></td>

              <td><small>
              {{ $notification->formatted_discontinued }}
              </small></td>

              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $notification->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->getComponent(15) as $module)
            <tr>
              <td><small>
              {{ $module->pivot->quantity }}
              </small></td>

              <td><small>
              {{ $module->pivot->name }}
              </small></td>

              <td><small>
              <a href="/manufacturer/{{ $module->manufacturer->id }}">
              {{ $module->manufacturer->name }}
              </a>
              </small></td>

              <td><small>
              <a href="/component/{{ $module->id }}">
              {{ $module->model }}
              </a>
              </small></td>

              <td width="30%"><small>
              {{ $module->formatted_description }}
              </small></td>

              <td><small>
              {{ $module->component_category->name }}
              </small></td>

              <td><small>
              {{ $module->formatted_discontinued }}
              </small></td>

              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $module->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->getComponent(10) as $miscelectrical)
            <tr>
              <td><small>
              {{ $miscelectrical->pivot->quantity }}
              </small></td>

              <td><small>
              {{ $miscelectrical->pivot->name }}
              </small></td>

              <td><small>
              <a href="/manufacturer/{{ $miscelectrical->manufacturer->id }}">
              {{ $miscelectrical->manufacturer->name }}
              </a>
              </small></td>

              <td><small>
              <a href="/component/{{ $miscelectrical->id }}">
              {{ $miscelectrical->model }}
              </a>
              </small></td>

              <td width="30%"><small>
              {{ $miscelectrical->formatted_description }}
              </small></td>

              <td><small>
              {{ $miscelectrical->component_category->name }}
              </small></td>

              <td><small>
              {{ $miscelectrical->formatted_discontinued }}
              </small></td>

              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $miscelectrical->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->getComponent(11) as $miscellaneous)
            <tr>
              <td><small>
              {{ $miscellaneous->pivot->quantity }}
              </small></td>

              <td><small>
              {{ $miscellaneous->pivot->name }}
              </small></td>

              <td><small>
              <a href="/manufacturer/{{ $miscellaneous->manufacturer->id }}">
              {{ $miscellaneous->manufacturer->name }}
              </a>
              </small></td>

              <td><small>
              <a href="/component/{{ $miscellaneous->id }}">
              {{ $miscellaneous->model }}
              </a>
              </small></td>

              <td width="30%"><small>
              {{ $miscellaneous->formatted_description }}
              </small></td>

              <td><small>
              {{ $miscellaneous->component_category->name }}
              </small></td>

              <td><small>
              {{ $miscellaneous->formatted_discontinued }}
              </small></td>

              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $miscellaneous->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->getComponent(6) as $accessory)
            <tr>
              <td><small>
              {{ $accessory->pivot->quantity }}
              </small></td>

              <td><small>
              {{ $accessory->pivot->name }}
              </small></td>

              <td><small>
              <a href="/manufacturer/{{ $accessory->manufacturer->id }}">
              {{ $accessory->manufacturer->name }}
              </a>
              </small></td>

              <td><small>
              <a href="/component/{{ $accessory->id }}">
              {{ $accessory->model }}
              </a>
              </small></td>

              <td width="30%"><small>
              {{ $accessory->formatted_description }}
              </small></td>

              <td><small>
              {{ $accessory->component_category->name }}
              </small></td>

              <td><small>
              {{ $accessory->formatted_discontinued }}
              </small></td>

              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $accessory->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->getComponent(12) as $uncategorized)
            <tr>
              <td><small>
              {{ $uncategorized->pivot->quantity }}
              </small></td>

              <td><small>
              {{ $uncategorized->pivot->name }}
              </small></td>

              <td><small>
              <a href="/manufacturer/{{ $uncategorized->manufacturer->id }}">
              {{ $uncategorized->manufacturer->name }}
              </a>
              </small></td>

              <td><small>
              <a href="/component/{{ $uncategorized->id }}">
              {{ $uncategorized->model }}
              </a>
              </small></td>

              <td width="30%"><small>
              {{ $uncategorized->formatted_description }}
              </small></td>

              <td><small>
              {{ $uncategorized->component_category->name }}
              </small></td>

              <td><small>
              {{ $uncategorized->formatted_discontinued }}
              </small></td>

              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $uncategorized->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

        </tbody>
      </table>

    </div>

      @if ($system->getComponent(5)->count() > 0)

      <h5>Renewable Components</h5>

    <div class="table-responsive">

      <table class="table table-hover table-condensed">
        <thead>
          <tr class="info">
            <th><small>Quantity</small></th>
            <th><small>Name</small></th>
            <th><small>Manufacturer</small></th>
            <th><small>Model</small></th>
            <th><small>Description</small></th>
            <th><small>Category</small></th>
            <th><small>Discontinued?</small></th>
            <th></th>
          </tr>
        </thead>
      <tbody>

        @foreach($system->getComponent(5) as $renewable)
          <tr>
            <td width="5%"><small>
            {{ $renewable->pivot->quantity }}
            </small></td>

            <td width="15%"><small>
            {{ $renewable->pivot->name }}
            </small></td>

            <td width="10%"><small>
            <a href="/manufacturer/{{ $renewable->manufacturer->id }}">
            {{ $renewable->manufacturer->name }}
            </a>
            </small></td>

            <td width="10%"><small>
            <a href="/component/{{ $renewable->id }}">
            {{ $renewable->model }}
            </a>
            </small></td>

            <td width="30%"><small>
            {{ $renewable->formatted_description }}
            </small></td>

            <td width="15%"><small>
            {{ $renewable->component_category->name }}
            </small></td>

            <td width="10%"><small>
            {{ $renewable->formatted_discontinued }}
            </small></td>

            <td width="5%">

              <form action="/system/{{ $system->id }}/component/{{ $renewable->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
              </form>

            </td>
          </tr>
        @endforeach

      </tbody>
    </table>

  </div>

  @endif

      @if ($system->getComponent(7)->count() > 0)

      <h5>Agent Tanks</h5>

    <div class="table-responsive">

      <table class="table table-hover table-condensed">
        <thead>
          <tr class="info">
            <th><small>Quantity</small></th>
            <th><small>Name</small></th>
            <th><small>Manufacturer</small></th>
            <th><small>Model</small></th>
            <th><small>Description</small></th>
            <th><small>Category</small></th>
            <th><small>Discontinued?</small></th>
            <th></th>
          </tr>
        </thead>
      <tbody>

      @foreach($system->getComponent(7) as $tank)
        <tr>
          <td width="5%"><small>
          {{ $tank->pivot->quantity }}
          </small></td>

          <td width="15%"><small>
          {{ $tank->pivot->name }}
          </small></td>

          <td width="10%"><small>
          <a href="/manufacturer/{{ $tank->manufacturer->id }}">
          {{ $tank->manufacturer->name }}
          </a>
          </small></td>

          <td width="10%"><small>
          <a href="/component/{{ $tank->id }}">
          {{ $tank->model }}
          </a>
          </small></td>

          <td width="30%"><small>
          {{ $tank->formatted_description }}
          </small></td>

          <td width="15%"><small>
          {{ $tank->component_category->name }}
          </small></td>

          <td width="10%"><small>
          {{ $tank->formatted_discontinued }}
          </small></td>

          <td width="5%">

            <form action="/system/{{ $system->id }}/component/{{ $tank->pivot->id }}/detach" method="post" accept-charset="UTF-8">
              {{ csrf_field() }}
              <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
            </form>

          </td>
        </tr>
      @endforeach

      </tbody>
    </table>

  </div>

  @endif

  <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#attachComponentModal">
  <i class="fa fa-plus" aria-hidden="true"></i>
  </button>
  <hr>

  <div class="row">

    <div class="col-lg-6 no-gutter-right">

      <div class="panel panel-info">
        <div class="panel-heading">Tests & Inspections ({{ $system->tests()->count() }})</div>

          <table class="table table-condensed">
            <thead>
              <tr>
                <th><small>Test Date</small></th>
                <th><small>Technician</small></th>
                <th><small>Type</small></th>
                <th><small>Result</small></th>
                <th><small>Added By</small></th>
              </tr>
            </thead>
            <tbody>
              @foreach($system->tests as $test)
                <tr>
                <td><small><a href="/tests/{{ $test->id }}">{{ $test->test_date->format('F d, Y') }}</a></small></td>
                <td><small>{{ $test->technician->first_name }} {{ $test->technician->last_name }}</small></td>
                <td><small>{{ $test->test_type->name }}</small></td>
                <td><small>{{ $test->test_result->name }}</small></td>
                <td><small>{{ $test->addedBy->first_name }} {{ $test->addedBy->last_name }}</small></td>
              </tr>
              @endforeach
            </tbody>
          </table>

        <div class="panel-footer text-left">

          <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addTestModal">
            <i class="fa fa-plus" aria-hidden="true"></i>
          </button>

        </div>

      </div> <!-- END OF PANEL -->

    </div> <!-- END OF COL-6 -->

    <div class="col-lg-6">

      <div class="panel panel-info">
      <div class="panel-heading">System Documents</div>

        <table class="table table-condensed">
          <thead>
            <tr>
              <th><small>Name</small></th>
              <th><small>-</small></th>
              <th><small>-</small></th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>

      <div class="panel-body"></div>

      <div class="panel-footer text-left">

        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addSystemDocumentModal">
          <i class="fa fa-plus" aria-hidden="true"></i>
        </button>

      </div>

      </div> <!-- END OF PANEL -->

    </div> <!-- END OF COL-6 -->

  </div> <!-- END OF ROW -->

  <!-- PHOTOS PANEL -->

      <div class="panel panel-info">
        <div class="panel-heading">System Photos ({{ count($system->photos) }})</div>
        <div class="panel-body text-center">

          @if($photos->count() > 0)

            @foreach($photos as $photo)

              <div id="systemPhoto">
                <a href="/system/photo/{{ $photo->id }}/">
                <img src="https://s3-us-west-2.amazonaws.com/ssiwebstorage/customer-data/system_photos/thumbnails/thumb-{{ $photo->file_name }}.{{ $photo->ext }}" width="178px" height="auto"></a><br><br>
                <p><small><strong>{{ $photo->caption }}</strong><br>
                {{ $photo->getSize() }}</small></p>
              </div>

            @endforeach

          @endif

        </div>

        <div class="panel-footer text-left">

          <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addSystemPhotoModal">
            <i class="fa fa-plus" aria-hidden="true"></i>
          </button>

        </div>

      </div> <!-- END OF PANEL -->

      <div class="row">

        <div class="col-lg-6 no-gutter-right">

          <div class="panel panel-info">
          <div class="panel-heading">System Comments</div>

            <table class="table table-condensed">
              <thead>
                <tr>
                  <th><small>Comment</small></th>
                  <th><small>By</small></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>

          <div class="panel-body"></div>

          <div class="panel-footer text-left">

            <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addSystemCommentModal">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </button>

          </div>

          </div> <!-- END OF PANEL -->

        </div> <!-- END OF COL-6 -->

    </div> <!-- END OF ROW -->

</div> <!-- END OF COL-9 -->



  </div> <!-- END OF MAIN ROW -->
</div> <!-- END OF CONTAINER -->

@if ($system->next_test_date)
  @include('partials.modals.edit_next_test_date')
  @include('partials.modals.nullify_next_test_date')
@endif

@include('partials.modals.edit_system')
@include('partials.modals.delete_system')
@include('partials.modals.attach_component')
@include('partials.modals.add_test')
@include('partials.modals.add_system_photo')

@stop

@extends('layout')

@section('title', 'SSI-Extranet | System Record')

@section('content')

@include('partials.nav')

@include('partials.flash')

<div class="container-fluid">

  <br>
  <ol class="breadcrumb small">
    <li><a href="/customers">Customers</a></li>
    <li><a href="/customer/{{ $system->site->customer->id }}">{{ $system->site->customer->name }}</a></li>
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
      <div class="panel-heading">Site Info</div>
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
    <div class="panel panel-primary">
      <div class="panel-body">
        <p>
          <strong>Next Test Due:</strong> {{ $system->next_test_date->format('F Y') }}

          <hr>

          <button type="submit" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateNextTestDateModal">
            <i class="fa fa-cog"></i></button>

        </p>
      </div>
    </div>
    @endif

    <div class="panel panel-primary">
      <div class="panel-heading">Site Info</div>
      <div class="panel-body">
        <p>
          <small>
            <strong>Added:</strong> {{ $system->created_at->setTimezone('America/Los_Angeles')->format('F j, Y, g:i a') }}<br>
            <strong>Added By:</strong> {{ $system->addedBy->first_name }} {{ $system->addedBy->last_name }}<br>
            @if ($system->updated_by)
            <hr>
            <strong>Edited:</strong> {{ $system->updated_at->setTimezone('America/Los_Angeles')->format('F j, Y, g:i a') }}<br>
            <strong>Edited By:</strong> {{ $system->updatedBy->first_name }} {{ $system->updatedBy->last_name }}<br>
            @endif
          </small>
        </p>
      </div>
    </div>

    <div class="text-center">

      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateSystemModal">
        <i class="fa fa-cog"></i></button>
      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#deleteSystemModal">
        <i class="fa fa-trash-o"></i></button>

    </div>

  </div>

<!--          RIGHT SIDE CONTENT         -->

<div class="col-md-9">

  <div class="titleBar" style="margin-top: 0">
    <p>Components ({{ $system->count_components() }})</p>
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

          @foreach($system->compPanel() as $panel)
            <tr>
              <td width="5%"><small>{{ $panel->pivot->quantity }}</small></td>
              <td width="15%"><small>{{ $panel->pivot->name }}</small></td>
              <td width="10%"><small><a href="/manufacturers/{{ $panel->manufacturer->id }}">{{ $panel->manufacturer->name }}</a></small></td>
              <td width="10%"><small><a href="/component/{{ $panel->id }}">{{ $panel->model }}</a></small></td>
              <td width="30%"><small>
                @if(strlen($panel->description) > 125)
                  @php echo substr($panel->description, 0, 125) . '. . .' @endphp
                @else
                  {{ $panel->description }}
                @endif
              </small></td>
              <td width="15%"><small>{{ $panel->component_category->name }}</small></td>
              <td width="10%"><small>@if ($panel->discontinued === 1) Yes @else No @endif</small></td>
              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $panel->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compModularPanel() as $modularpanel)
            <tr>
              <td width="5%"><small>{{ $modularpanel->pivot->quantity }}</small></td>
              <td width="15%"><small>{{ $modularpanel->pivot->name }}</small></td>
              <td width="10%"><small><a href="/manufacturers/{{ $modularpanel->manufacturer->id }}">{{ $modularpanel->manufacturer->name }}</a></small></td>
              <td width="10%"><small><a href="/component/{{ $modularpanel->id }}">{{ $modularpanel->model }}</a></small></td>
              <td width="30%"><small>
                @if(strlen($modularpanel->description) > 125)
                  @php echo substr($modularpanel->description, 0, 125) . '. . .' @endphp
                @else
                  {{ $modularpanel->description }}
                @endif
              </small></td>
              <td width="15%"><small>{{ $modularpanel->component_category->name }}</small></td>
              <td width="10%"><small>@if ($modularpanel->discontinued === 1) Yes @else No @endif</small></td>
              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $modularpanel->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compControlEquipment() as $controlequipment)
            <tr>
              <td width="5%"><small>{{ $controlequipment->pivot->quantity }}</small></td>
              <td width="15%"><small>{{ $controlequipment->pivot->name }}</small></td>
              <td width="10%"><small><a href="/manufacturers/{{ $controlequipment->manufacturer->id }}">{{ $controlequipment->manufacturer->name }}</a></small></td>
              <td width="10%"><small><a href="/component/{{ $controlequipment->id }}">{{ $controlequipment->model }}</a></small></td>
              <td width="30%"><small>
                @if(strlen($controlequipment->description) > 125)
                  @php echo substr($controlequipment->description, 0, 125) . '. . .' @endphp
                @else
                  {{ $controlequipment->description }}
                @endif
              </small></td>
              <td width="15%"><small>{{ $controlequipment->component_category->name }}</small></td>
              <td width="10%"><small>@if ($controlequipment->discontinued === 1) Yes @else No @endif</small></td>
              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $controlequipment->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compAirSamplingDetection() as $airsamplingdetection)
            <tr>
              <td width="5%"><small>{{ $airsamplingdetection->pivot->quantity }}</small></td>
              <td width="15%"><small>{{ $airsamplingdetection->pivot->name }}</small></td>
              <td width="10%"><small><a href="/manufacturers/{{ $airsamplingdetection->manufacturer->id }}">{{ $airsamplingdetection->manufacturer->name }}</a></small></td>
              <td width="10%"><small><a href="/component/{{ $airsamplingdetection->id }}">{{ $airsamplingdetection->model }}</a></small></td>
              <td width="30%"><small>
                @if(strlen($airsamplingdetection->description) > 125)
                  @php echo substr($airsamplingdetection->description, 0, 125) . '. . .' @endphp
                @else
                  {{ $airsamplingdetection->description }}
                @endif
              </small></td>
              <td width="15%"><small>{{ $airsamplingdetection->component_category->name }}</small></td>
              <td width="10%"><small>@if ($airsamplingdetection->discontinued === 1) Yes @else No @endif</small></td>
              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $airsamplingdetection->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compDetection() as $detection)
            <tr>
              <td width="5%"><small>{{ $detection->pivot->quantity }}</small></td>
              <td width="15%"><small>{{ $detection->pivot->name }}</small></td>
              <td width="10%"><small><a href="/manufacturers/{{ $detection->manufacturer->id }}">{{ $detection->manufacturer->name }}</a></small></td>
              <td width="10%"><small><a href="/component/{{ $detection->id }}">{{ $detection->model }}</a></small></td>
              <td width="30%"><small>
                @if(strlen($detection->description) > 125)
                  @php echo substr($detection->description, 0, 125) . '. . .' @endphp
                @else
                  {{ $detection->description }}
                @endif
              </small></td>
              <td width="15%"><small>{{ $detection->component_category->name }}</small></td>
              <td width="10%"><small>@if ($detection->discontinued === 1) Yes @else No @endif</small></td>
              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $detection->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compNotification() as $notification)
            <tr>
              <td><small>{{ $notification->pivot->quantity }}</small></td>
              <td><small>{{ $notification->pivot->name }}</small></td>
              <td><small><a href="/manufacturers/{{ $notification->manufacturer->id }}">{{ $notification->manufacturer->name }}</a></small></td>
              <td><small><a href="/component/{{ $notification->id }}">{{ $notification->model }}</a></small></td>
              <td width="30%"><small>
                @if(strlen($notification->description) > 125)
                  @php echo substr($notification->description, 0, 125) . '. . .' @endphp
                @else
                  {{ $notification->description }}
                @endif
              </small></td>
              <td><small>{{ $notification->component_category->name }}</small></td>
              <td><small>@if ($notification->discontinued === 1) Yes @else No @endif</small></td>
              <td>

                <form action="/system/{{ $system->id }}/component/{{ $notification->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compModules() as $modules)
            <tr>
              <td><small>{{ $modules->pivot->quantity }}</small></td>
              <td><small>{{ $modules->pivot->name }}</small></td>
              <td><small><a href="/manufacturers/{{ $modules->manufacturer->id }}">{{ $modules->manufacturer->name }}</a></small></td>
              <td><small><a href="/component/{{ $modules->id }}">{{ $modules->model }}</a></small></td>
              <td width="30%"><small>
                @if(strlen($modules->description) > 125)
                  @php echo substr($modules->description, 0, 125) . '. . .' @endphp
                @else
                  {{ $modules->description }}
                @endif
              </small></td>
              <td><small>{{ $modules->component_category->name }}</small></td>
              <td><small>@if ($modules->discontinued === 1) Yes @else No @endif</small></td>
              <td>

                <form action="/system/{{ $system->id }}/component/{{ $modules->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compMiscElectrical() as $miscelectrical)
            <tr>
              <td><small>{{ $miscelectrical->pivot->quantity }}</small></td>
              <td><small>{{ $miscelectrical->pivot->name }}</small></td>
              <td><small><a href="/manufacturers/{{ $miscelectrical->manufacturer->id }}">{{ $miscelectrical->manufacturer->name }}</a></small></td>
              <td><small><a href="/component/{{ $miscelectrical->id }}">{{ $miscelectrical->model }}</a></small></td>
              <td width="30%"><small>
                @if(strlen($miscelectrical->description) > 125)
                  @php echo substr($miscelectrical->description, 0, 125) . '. . .' @endphp
                @else
                  {{ $miscelectrical->description }}
                @endif
              </small></td>
              <td><small>{{ $miscelectrical->component_category->name }}</small></td>
              <td><small>@if ($miscelectrical->discontinued === 1) Yes @else No @endif</small></td>
              <td>

                <form action="/system/{{ $system->id }}/component/{{ $miscelectrical->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compMisc() as $misc)
            <tr>
              <td><small>{{ $misc->pivot->quantity }}</small></td>
              <td><small>{{ $misc->pivot->name }}</small></td>
              <td><small><a href="/manufacturers/{{ $misc->manufacturer->id }}">{{ $misc->manufacturer->name }}</a></small></td>
              <td><small><a href="/component/{{ $misc->id }}">{{ $misc->model }}</a></small></td>
              <td width="30%"><small>
                @if(strlen($misc->description) > 125)
                  @php echo substr($misc->description, 0, 125) . '. . .' @endphp
                @else
                  {{ $misc->description }}
                @endif
              </small></td>
              <td><small>{{ $misc->component_category->name }}</small></td>
              <td><small>@if ($misc->discontinued === 1) Yes @else No @endif</small></td>
              <td>

                <form action="/system/{{ $system->id }}/component/{{ $misc->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compAccessory() as $accessory)
            <tr>
              <td><small>{{ $accessory->pivot->quantity }}</small></td>
              <td><small>{{ $accessory->pivot->name }}</small></td>
              <td><small><a href="/manufacturers/{{ $accessory->manufacturer->id }}">{{ $accessory->manufacturer->name }}</a></small></td>
              <td><small><a href="/component/{{ $accessory->id }}">{{ $accessory->model }}</a></small></td>
              <td width="30%"><small>
                @if(strlen($accessory->description) > 125)
                  @php echo substr($accessory->description, 0, 125) . '. . .' @endphp
                @else
                  {{ $accessory->description }}
                @endif
              </small></td>
              <td><small>{{ $accessory->component_category->name }}</small></td>
              <td><small>@if ($accessory->discontinued === 1) Yes @else No @endif</small></td>
              <td>

                <form action="/system/{{ $system->id }}/component/{{ $accessory->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compUncategorized() as $uncategorized)
            <tr>
              <td><small>{{ $uncategorized->pivot->quantity }}</small></td>
              <td><small>{{ $uncategorized->pivot->name }}</small></td>
              <td><small><a href="/manufacturers/{{ $uncategorized->manufacturer->id }}">{{ $uncategorized->manufacturer->name }}</a></small></td>
              <td><small><a href="/component/{{ $uncategorized->id }}">{{ $uncategorized->model }}</a></small></td>
              <td width="30%"><small>
                @if(strlen($uncategorized->description) > 125)
                  @php echo substr($uncategorized->description, 0, 125) . '. . .' @endphp
                @else
                  {{ $uncategorized->description }}
                @endif
              </small></td>
              <td><small>{{ $uncategorized->component_category->name }}</small></td>
              <td><small>@if ($uncategorized->discontinued === 1) Yes @else No @endif</small></td>
              <td>

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

      @if ($system->compConsumable()->count() > 0)

      <br>
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

        @foreach($system->compConsumable() as $consumable)
          <tr>
            <td width="5%"><small>{{ $consumable->pivot->quantity }}</small></td>
            <td width="15%"><small>{{ $consumable->pivot->name }}</small></td>
            <td width="10%"><small><a href="/manufacturers/{{ $consumable->manufacturer->id }}">{{ $consumable->manufacturer->name }}</a></small></td>
            <td width="10%"><small><a href="/component/{{ $consumable->id }}">{{ $consumable->model }}</a></small></td>
            <td width="30%"><small>
              @if(strlen($consumable->description) > 125)
                @php echo substr($consumable->description, 0, 125) . '. . .' @endphp
              @else
                {{ $consumable->description }}
              @endif
            </small></td>
            <td width="15%"><small>{{ $consumable->component_category->name }}</small></td>
            <td width="10%"><small>@if ($consumable->discontinued === 1) Yes @else No @endif</small></td>
            <td width="5%">

              <form action="/system/{{ $system->id }}/component/{{ $consumable->pivot->id }}/detach" method="post" accept-charset="UTF-8">
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

      @if ($system->compTank()->count() > 0)

      <br>
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

        @foreach($system->compTank() as $tank)
          <tr>
            <td width="5%"><small>{{ $tank->pivot->quantity }}</small></td>
            <td width="15%"><small>{{ $tank->pivot->name }}</small></td>
            <td width="10%"><small><a href="/manufacturers/{{ $tank->manufacturer->id }}">{{ $tank->manufacturer->name }}</a></small></td>
            <td width="10%"><small><a href="/component/{{ $tank->id }}">{{ $tank->model }}</a></small></td>
            <td width="30%"><small>
              @if(strlen($tank->description) > 125)
                @php echo substr($tank->description, 0, 125) . '. . .' @endphp
              @else
                {{ $tank->description }}
              @endif
            </small></td>
            <td width="15%"><small>{{ $tank->component_category->name }}</small></td>
            <td width="10%"><small>@if ($tank->discontinued === 1) Yes @else No @endif</small></td>
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
        <div class="panel-heading">Tests & Inspections ({{ count($system->tests) }})</div>

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

    <div class="col-lg-6 no-gutter-right">

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
                  <th><small>Job #</small></th>
                  <th><small>Name</small></th>
                  <th><small>Scope of Work</small></th>
                  <th><small>Stage</small></th>
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
@endif

@include('partials.modals.edit_system')
@include('partials.modals.delete_system')
@include('partials.modals.attach_component')
@include('partials.modals.add_test')
@include('partials.modals.add_system_photo')

@stop

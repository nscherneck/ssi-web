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

    <div class="headerBar text-center">
      <h3>{{ $system->name }}</h3>
    </div>

    <div class="contentBar">

      <p><small>
        <strong>System Type:</strong> {{ $system->system_type->type }}<br>
        <strong>Installation Date:</strong> {{ $system->install_date->format('F d, Y') }}<br>
        <hr>
        <strong>Installed by SSI:</strong>@if ($system->ssi_install == 1) Yes @else No @endif<br>
        <strong>Testing by SSI:</strong>@if ($system->ssi_test_acct == 1) Yes @else No @endif<br>
      </small></p>

    </div>

    @if ($system->next_test_date)
    <div class="contentBar text-center">

      <p><strong>Next Test Due:</strong> {{ $system->next_test_date->format('F Y') }}

        <hr>

        <button type="submit" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateNextTestDateModal">
          <i class="fa fa-cog fa-md"></i></button>

      </p>

    </div>
    @endif

    <div class="contentBar">

      <p><small>
        <strong>Added:</strong> {{ $system->created_at->setTimezone('America/Los_Angeles')->format('F j, Y, g:i a') }}<br>
        <strong>Added By:</strong> {{ $system->addedBy->first_name }} {{ $system->addedBy->last_name }}<br>
        @if ($system->updated_by)
        <hr>
        <strong>Edited:</strong> {{ $system->updated_at->setTimezone('America/Los_Angeles')->format('F j, Y, g:i a') }}<br>
        <strong>Edited By:</strong> {{ $system->updatedBy->first_name }} {{ $system->updatedBy->last_name }}<br>
        @endif
      </small></p>
    </div>


    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateSystemModal">
      <i class="fa fa-cog fa-md"></i> Edit System</button>
    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteSystemModal">
      <i class="fa fa-trash-o fa-md"></i> Delete System</button>
    <br><br>

  </div>

<!--          RIGHT SIDE CONTENT         -->

<div class="col-md-9">

<style>
  button.accordion {
      background-color: #eee;
      color: #444;
      cursor: pointer;
      padding: 6px;
      width: 100%;
      border:1px solid gray;
      border-radius: 5px;
      text-align: center;
      outline: none;
      font-size: 10px;
      transition: 0.4s;
  }

  button.accordion.active, button.accordion:hover {
      background-color: #999;
      color: #fff;

  }

  div.panel {
      padding: 8px 4px;
      display: none;
      background-color: white;
  }

  div.panel.show {
      display: block;
  }
</style>

  <button class="accordion">Components ({{ $system->count_components() }})</button>
  <div class="panel">

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
              <td width="10%"><small>{{ $panel->manufacturer->name }}</small></td>
              <td width="10%"><small><a href="/component/{{ $panel->id }}">{{ $panel->model }}</a></small></td>
              <td width="30%"><small>{{ $panel->description }}</small></td>
              <td width="15%"><small>{{ $panel->component_category->name }}</small></td>
              <td width="10%"><small>@if ($panel->discontinued === 1) Yes @else No @endif</small></td>
              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $panel->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o fa-md"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compModularPanel() as $modularpanel)
            <tr>
              <td width="5%"><small>{{ $modularpanel->pivot->quantity }}</small></td>
              <td width="15%"><small>{{ $modularpanel->pivot->name }}</small></td>
              <td width="10%"><small>{{ $modularpanel->manufacturer->name }}</small></td>
              <td width="10%"><small>{{ $modularpanel->model }}</small></td>
              <td width="30%"><small>{{ $modularpanel->description }}</small></td>
              <td width="15%"><small>{{ $modularpanel->component_category->name }}</small></td>
              <td width="10%"><small>@if ($modularpanel->discontinued === 1) Yes @else No @endif</small></td>
              <td width="5%">

                <form action="/system/{{ $system->id }}/component/{{ $modularpanel->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o fa-md"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compControlEquipment() as $controlequipment)
            <tr>
              <td><small>{{ $controlequipment->pivot->quantity }}</small></td>
              <td><small>{{ $controlequipment->pivot->name }}</small></td>
              <td><small>{{ $controlequipment->manufacturer->name }}</small></td>
              <td><small>{{ $controlequipment->model }}</small></td>
              <td><small>{{ $controlequipment->description }}</small></td>
              <td><small>{{ $controlequipment->component_category->name }}</small></td>
              <td><small>@if ($controlequipment->discontinued === 1) Yes @else No @endif</small></td>
              <td>

                <form action="/system/{{ $system->id }}/component/{{ $controlequipment->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o fa-md"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compAirSamplingDetection() as $airsamplingdetection)
            <tr>
              <td><small>{{ $airsamplingdetection->pivot->quantity }}</small></td>
              <td><small>{{ $airsamplingdetection->pivot->name }}</small></td>
              <td><small>{{ $airsamplingdetection->manufacturer->name }}</small></td>
              <td><small>{{ $airsamplingdetection->model }}</small></td>
              <td><small>{{ $airsamplingdetection->description }}</small></td>
              <td><small>{{ $airsamplingdetection->component_category->name }}</small></td>
              <td><small>@if ($airsamplingdetection->discontinued === 1) Yes @else No @endif</small></td>
              <td>

                <form action="/system/{{ $system->id }}/component/{{ $airsamplingdetection->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o fa-md"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compDetection() as $detection)
            <tr>
              <td><small>{{ $detection->pivot->quantity }}</small></td>
              <td><small>{{ $detection->pivot->name }}</small></td>
              <td><small>{{ $detection->manufacturer->name }}</small></td>
              <td><small>{{ $detection->model }}</small></td>
              <td><small>{{ $detection->description }}</small></td>
              <td><small>{{ $detection->component_category->name }}</small></td>
              <td><small>@if ($detection->discontinued === 1) Yes @else No @endif</small></td>
              <td>

                <form action="/system/{{ $system->id }}/component/{{ $detection->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o fa-md"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compNotification() as $notification)
            <tr>
              <td><small>{{ $notification->pivot->quantity }}</small></td>
              <td><small>{{ $notification->pivot->name }}</small></td>
              <td><small>{{ $notification->manufacturer->name }}</small></td>
              <td><small>{{ $notification->model }}</small></td>
              <td><small>{{ $notification->description }}</small></td>
              <td><small>{{ $notification->component_category->name }}</small></td>
              <td><small>@if ($notification->discontinued === 1) Yes @else No @endif</small></td>
              <td>

                <form action="/system/{{ $system->id }}/component/{{ $notification->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o fa-md"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compModules() as $modules)
            <tr>
              <td><small>{{ $modules->pivot->quantity }}</small></td>
              <td><small>{{ $modules->pivot->name }}</small></td>
              <td><small>{{ $modules->manufacturer->name }}</small></td>
              <td><small>{{ $modules->model }}</small></td>
              <td><small>{{ $modules->description }}</small></td>
              <td><small>{{ $modules->component_category->name }}</small></td>
              <td><small>@if ($modules->discontinued === 1) Yes @else No @endif</small></td>
              <td>

                <form action="/system/{{ $system->id }}/component/{{ $modules->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o fa-md"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compMiscElectrical() as $miscelectrical)
            <tr>
              <td><small>{{ $miscelectrical->pivot->quantity }}</small></td>
              <td><small>{{ $miscelectrical->pivot->name }}</small></td>
              <td><small>{{ $miscelectrical->manufacturer->name }}</small></td>
              <td><small>{{ $miscelectrical->model }}</small></td>
              <td><small>{{ $miscelectrical->description }}</small></td>
              <td><small>{{ $miscelectrical->component_category->name }}</small></td>
              <td><small>@if ($miscelectrical->discontinued === 1) Yes @else No @endif</small></td>
              <td>

                <form action="/system/{{ $system->id }}/component/{{ $miscelectrical->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o fa-md"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compMisc() as $misc)
            <tr>
              <td><small>{{ $misc->pivot->quantity }}</small></td>
              <td><small>{{ $misc->pivot->name }}</small></td>
              <td><small>{{ $misc->manufacturer->name }}</small></td>
              <td><small>{{ $misc->model }}</small></td>
              <td><small>{{ $misc->description }}</small></td>
              <td><small>{{ $misc->component_category->name }}</small></td>
              <td><small>@if ($misc->discontinued === 1) Yes @else No @endif</small></td>
              <td>

                <form action="/system/{{ $system->id }}/component/{{ $misc->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o fa-md"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compAccessory() as $accessory)
            <tr>
              <td><small>{{ $accessory->pivot->quantity }}</small></td>
              <td><small>{{ $accessory->pivot->name }}</small></td>
              <td><small>{{ $accessory->manufacturer->name }}</small></td>
              <td><small>{{ $accessory->model }}</small></td>
              <td><small>{{ $accessory->description }}</small></td>
              <td><small>{{ $accessory->component_category->name }}</small></td>
              <td><small>@if ($accessory->discontinued === 1) Yes @else No @endif</small></td>
              <td>

                <form action="/system/{{ $system->id }}/component/{{ $accessory->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o fa-md"></i></button>
                </form>

              </td>
            </tr>
          @endforeach

          @foreach($system->compUncategorized() as $uncategorized)
            <tr>
              <td><small>{{ $uncategorized->pivot->quantity }}</small></td>
              <td><small>{{ $uncategorized->pivot->name }}</small></td>
              <td><small>{{ $uncategorized->manufacturer->name }}</small></td>
              <td><small>{{ $uncategorized->model }}</small></td>
              <td><small>{{ $uncategorized->description }}</small></td>
              <td><small>{{ $uncategorized->component_category->name }}</small></td>
              <td><small>@if ($uncategorized->discontinued === 1) Yes @else No @endif</small></td>
              <td>

                <form action="/system/{{ $system->id }}/component/{{ $uncategorized->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o fa-md"></i></button>
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
            <td width="10%"><small>{{ $consumable->manufacturer->name }}</small></td>
            <td width="10%"><small>{{ $consumable->model }}</small></td>
            <td width="30%"><small>{{ $consumable->description }}</small></td>
            <td width="15%"><small>{{ $consumable->component_category->name }}</small></td>
            <td width="10%"><small>@if ($consumable->discontinued === 1) Yes @else No @endif</small></td>
            <td width="5%">

              <form action="/system/{{ $system->id }}/component/{{ $consumable->pivot->id }}/detach" method="post" accept-charset="UTF-8">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash-o fa-md"></i></button>
              </form>

            </td>
          </tr>
        @endforeach

      </tbody>
    </table>

  </div>

  @endif

  <hr>
  <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#attachComponentModal">Attach Component</button>

  </div>

  <button class="accordion">Tests & Inspections ({{ count($system->tests) }})</button>
  <div class="panel">

    <div class="table-responsive">

      <table class="table table-striped table-condensed">
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

    </div>

    <hr>

    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addTestModal">Add Test</button>

  </div>

  <button class="accordion">Documents (0)</button>
  <div class="panel">

    Lorem ipsum dolor amet. 3<br>
    Lorem ipsum dolor amet. 3<br>

    <hr>
    <a href="#"><small>Add a Document</small></a>

  </div>

  <button class="accordion">Photos ({{ count($system->photos) }})</button>
  <div class="panel">

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

    <hr>
    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addSystemPhotoModal">Add Photo</button>

  </div>

  <button class="accordion">Comments (0)</button>
  <div class="panel">

    Lorem ipsum dolor amet. 5<br>
    Lorem ipsum dolor amet. 5<br>

    <hr>
    <a href="#"><small>Add a Comment</small></a>

  </div>
  <br><br>

  <script>
  var acc = document.getElementsByClassName("accordion");
  var i;

  for (i = 0; i < acc.length; i++) {
      acc[i].onclick = function(){
          this.classList.toggle("active");
          this.nextElementSibling.classList.toggle("show");
    }
  }
  </script>

    </div>
  </div>
</div>

@if ($system->next_test_date)
  @include('partials.modals.edit_next_test_date')
@endif

@include('partials.modals.edit_system')
@include('partials.modals.delete_system')
@include('partials.modals.attach_component')
@include('partials.modals.add_test')
@include('partials.modals.add_system_photo')

@stop

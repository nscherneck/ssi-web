@extends('layout')

@section('title', 'SSI-Extranet | Manufacturer')

@section('head')

<style type="text/css">
   body { background: #3c8987 !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
</style>

@stop

@section('content')

@include('partials.nav')

@include('partials.flash')

<div class="container">
  <div class="">
    <br>
    <ol class="breadcrumb small">
      <li><a href="/manufacturers">Manufacturers</a></li>
      <li>{{ $manufacturer->name }}</li>
    </ol>
  </div>

  <div class="row">

    <div class="col-md-12">

      <div class="row">

            <div class="col-md-6 no-gutter-right">

              <div class="panel panel-default">
                <div class="panel-heading">General Information</div>
                <div class="panel-body">

                  <p>
                  <small>
                    @if($manufacturer->address1){{ $manufacturer->address1 }}<br>@endif
                    @if($manufacturer->address2){{ $manufacturer->address2 }}<br>@endif
                    @if($manufacturer->city){{ $manufacturer->city }},@endif @if($manufacturer->state_id){{ $manufacturer->state->abbreviated }}@endif @if($manufacturer->zip){{ $manufacturer->zip }}@endif
                  </small>
                  </p>
                  <hr>
                  <p>
                  <small>
                    @if($manufacturer->phone)<strong>Phone:</strong> {{ $manufacturer->phone }}<br>@endif
                    @if($manufacturer->fax)<strong>Fax:</strong> {{ $manufacturer->fax }}<br>@endif
                    @if($manufacturer->web)<strong>Website:</strong> <a href="{{ $manufacturer->web }}" target="blank">{{ $manufacturer->web }}</a><br>@endif
                    @if($manufacturer->distributor_login)<strong>Distributor Website:</strong> <a href="{{ $manufacturer->distributor_login }}" target="blank">{{ $manufacturer->distributor_login }}</a><br>@endif
                    @if($manufacturer->email)<strong>Email:</strong> <a href="mailto:{{ $manufacturer->email }}">{{ $manufacturer->email }}</a>@endif
                  </small>
                  </p>

                  <button type="submit" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateManufacturerModal">
                    <i class="fa fa-cog"></i></button>

                </div>
              </div>
            </div>

            <div class="col-md-6">

              <div class="panel panel-default">
                <div class="panel-heading">Notes</div>
                <div class="panel-body">

                  @if($manufacturer->notes)
                    <p>
                      {{ $manufacturer->notes }}
                    </p>
                    <hr>
                  @endif

                  <p><small>
                    <strong>Added:</strong> {{ $manufacturer->created_at->setTimezone('America/Los_Angeles')->format('F j, Y, g:i a') }}<br>
                    <strong>Added By:</strong> {{ $manufacturer->addedBy->first_name }} {{ $manufacturer->addedBy->last_name }}<br>
                    @if($manufacturer->updated_by)
                    <hr>
                    <strong>Edited:</strong> {{ $manufacturer->updated_at->setTimezone('America/Los_Angeles')->format('F j, Y, g:i a') }}<br>
                    <strong>Edited By:</strong> {{ $manufacturer->updatedBy->first_name }} {{ $manufacturer->updatedBy->last_name }}<br>
                    @endif
                  </small></p>

                </div>
              </div>

            </div>

      </div>

      <div class="panel panel-default">
        <div class="panel-heading">Components ({{ $components->count() }})</div>

        <table class="table table-condensed">
          <thead>
            <tr>
              <th><small><a href="/manufacturers/{{ $manufacturer->id }}?sort=model">Model</small></th>
              <th><small>Description</a></small></th>
              <th><small><a href="/manufacturers/{{ $manufacturer->id }}?sort=component_category_id">Category</a></small></th>
            </tr>
          </thead>
          <tbody>
            @foreach($components as $component)
              <tr>
              <td width="15%"><small><a href="/component/{{ $component->id }}">{{ $component->model }}</a></small></td>
              <td width="60%"><small>
                @if(strlen($component->description) > 110)
                  @php echo substr($component->description, 0, 110) . '. . .' @endphp
                @else
                  {{ $component->description }}
                @endif
              </small></td>
              <td width="25%"><small>{{ $component->component_category->name }}</small></td>
            </tr>
            @endforeach
          </tbody>
        </table>


    </div>

  </div>

</div>

@include('partials.modals.edit_manufacturer')

@stop

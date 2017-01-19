@extends('layout')

@section('title', 'SSI-Extranet | Manufacturer')

@section('content')

@include('partials.nav')

@include('partials.flash')

<div class="container">
  <div class="text-center">
    <h3>{{ $manufacturer->name }}</h3>
  </div>

  <div class="row">

    <div class="col-md-12">

      <div class="titleBar">
          <p>Components</p>
      </div>

      <div class="table-responsive">

        <table class="table table-condensed">
          <thead>
            <tr>
              <th><small><a href="/manufacturers/{{ $manufacturer->id }}?sort=model">Model</small></th>
              <th><small>Description</a></small></th>
              <th><small><a href="/manufacturers/{{ $manufacturer->id }}?sort=component_category_id">Category</a></small></th>
              <th><small>Discontinued</small></th>
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
              <td width="15%"><small>{{ $component->component_category->name }}</small></td>
              <td width="10%"><small>@if ($component->discontinued === 1) Yes @else No @endif</small></td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>


    </div>

  </div>

</div>

@stop

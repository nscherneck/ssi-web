@extends('layout')

@section('title', 'SSI-Extranet | Manufacturer')

@section('content')

@include('partials.nav')

<div class="container-fluid">

  @include('partials.flash')
  <br>
  @include('manufacturers.partials.breadcrumbs')
  
  <div class="text-center">
    <h2>{{ $manufacturer->name }}</h2>
    <hr>
  </div>

  <div class="row">

    <div class="col-lg-3">
      @include('manufacturers.partials.general_info_panel')
      @include('partials.meta_panel', ['color' => 'primary', 'model' => 'manufacturer'])
      @include('partials.notes_panel', ['color' => 'primary', 'model' => 'manufacturer'])
      @include('manufacturers.partials.buttons')
    </div> <!-- ./3-column -->
    
    <div class="col-lg-9">
      @include('manufacturers.partials.components_panel')
      <br>
      @can('Create Component')
        @include('components.create')
      @endcan
    </div>  <!-- ./9-column -->  
        
    </div> <!-- ./row -->   
  </div> <!-- ./container -->   

@can('Edit Manufacturer')
  @include('partials.modals.edit_manufacturer')
@endcan

@endsection

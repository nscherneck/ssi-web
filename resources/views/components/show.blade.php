@extends('layout')

@section('title', 'SSI-Extranet | Component')

@section('content')

@include('partials.nav')

<div class="container-fluid">

  @include('partials.flash')

  @include('components.partials.breadcrumbs')
  @include('components.partials.content_heading')
  @include('components.partials.content')
  @include('components.partials.buttons')
  
  <hr>
  
  @can('View Component Document')
    @include('components.partials.documents_panel')
  @endcan
  
  @include('components.partials.installed_panel')

  @can('Edit Component')
    @include('partials.modals.edit_component')
  @endcan
  @can('Delete Component')
    @include('partials.modals.delete_component')
  @endcan
  @can('Create Component Document')
    @include('partials.modals.add_component_document')
  @endcan
  
</div> <!-- ./container -->
@endsection

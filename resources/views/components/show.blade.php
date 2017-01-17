@extends('layout')

@section('title', 'SSI-Extranet | Test')

@section('content')

@include('partials.nav')

@include('partials.flash')

<div class="container">
  <div class="text-center">

  </div>

  <br>
  <h4>{{ $component->manufacturer->name }}</h4>
  <h3>{{ $component->model }}</h3>
  <br>

  @if($component->discontinued === 1)
    <h5><strong>THIS PART HAS BEEN DISCONTINUED BY THE MANUFACTURER</strong></h5>
    <br>
  @endif

<div class="row">

  <div class="col-md-6">

    <p>{{ $component->description }}</p>

  </div>

  <div class="col-md-6">

    <div class="pull-right">

      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateComponentModal">
        <i class="fa fa-cog"></i></button>

    </div>

  </div>


</div>

  <div class="titleBar">
      <p>Documents</p>
  </div>

  <div class="row">

    @if($documents->count() > 0)

    <div class="col-md-12">

      <div class="table-responsive">

        <table class="table table-condensed">
          <thead>
            <tr>
              <th><small>File</small></th>
              <th><small>Description</small></th>
              <th><small></small></th>
              <th><small></small></th>
            </tr>
          </thead>
          <tbody>
            @foreach($documents as $document)
            <tr>
            <td width="40%"><a href="https://s3-us-west-2.amazonaws.com/ssiwebstorage/{{ $document->path }}/{{ $document->file_name }}.{{ $document->ext }}" target="blank">
              {{ $document->file_name }}.{{ $document->ext }}
              </a>
            </td>
            <td width="54%">{{ $document->description }}</td>
            <td width="3%">
              <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#">
                <i class="fa fa-cog"></i></button>
            </td>
            <td width="3%">
              <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#deleteSystemModal">
                <i class="fa fa-trash"></i></button>
            </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <hr>

      </div>

    </div>

    @endif

    <div class="col-md-12">

      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addComponentDocumentModal">
        <i class="fa fa-plus"></i></button>
      <br>

    </div>


  </div>

  <div class="titleBar">
      <p>Where It's Installed</p>
  </div>

  <div class="table-responsive">

    <table class="table table-condensed">
      <thead>
        <tr>
          <th><small>Customer</small></th>
          <th><small>Site</small></th>
          <th><small>System</small></th>
        </tr>
      </thead>
      <tbody>
        @foreach($component->systems as $system)
          <tr>
          <td><small><a href="/customer/{{ $system->site->customer->id }}">{{ $system->site->customer->name }}</a></small></td>
          <td><small><a href="/site/{{ $system->site->id }}">{{ $system->site->name }}</a></small></td>
          <td><small><a href="/system/{{ $system->id }}">{{ $system->name }}</a></small></td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
  <br>

  <div class="titleBar">
      <p>Comments</p>
  </div>


  </div>
</div>

@include('partials.modals.edit_component')
@include('partials.modals.add_component_document')

@stop

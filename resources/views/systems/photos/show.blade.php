@extends('layout')

@section('title', 'SSI-Extranet | System Photo')

@section('content')

@include('partials.nav')

<div class="container-fluid">

  @include('partials.flash')

  <br>
  <ol class="breadcrumb small">
    <li><a href="/customers">Customers</a></li>
    <li><a href="/customer/{{ $system->site->customer->id }}">{{ $system->site->customer->name }}</a></li>
    <li><a href="/site/{{ $system->site->id }}">{{ $system->site->name }}</a></li>
    <li><a href="/system/{{ $system->id }}">{{ $system->name }}</a></li>
    <li>Photo</li>
  </ol>

  <div class="text-center">
    
    <img 
      src="{{ env('SYSTEM_PHOTO_URL') }}{{ $photo->file_name }}.{{ $photo->ext }}" 
      width="100%" 
      height="auto"
    >

    <hr>

    <!-- BEGIN CONTROL BUTTONS -->
    <form 
      class="" 
      action="/system/{{ $system->id }}/photo/{{ $photo->id }}/rotateleft" 
      method="post" 
      style="display: inline"
    >
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="put">
      <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-rotate-left fa-md"></i></button>
    </form>

    <button type="submit" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateSystemPhotoModal">
      <i class="fa fa-cog fa-md"></i></button>
    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#deleteSystemPhotoModal">
      <i class="fa fa-trash-o fa-md"></i></button>

    <form 
      class="" 
      action="/system/{{ $system->id }}/photo/{{ $photo->id }}/rotateright" 
      method="post" 
      style="display: inline"
    >
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="put">
      <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-rotate-right fa-md"></i></button>
    </form>

    <hr>
    <!-- BEGIN PHOTO META -->
    <p><small>{{ $photo->caption }}</small><br>
    <small><strong>Added By: </strong>{{ $photo->addedBy->full_name }}<br>
    <strong>Added: </strong>{{ $photo->formatted_created_at }}<br>
    <strong>File Size: </strong>{{ $photo->getFilesize() }}<br></p>

  </div>
</div> <!-- END CONTAINER -->

@include('partials.modals.edit_system_photo')
@include('partials.modals.delete_system_photo')

@stop

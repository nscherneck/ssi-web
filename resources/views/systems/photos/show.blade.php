@extends('layout')

@section('title', 'SSI-Extranet | System Photo')

@section('content')

@include('partials.nav')

<div class="container-fluid">

  @include('partials.flash')

  <br>
  <ol class="breadcrumb small">
    <li><a href="/customers">Customers</a></li>
    <li><a href="{{ $system->site->customer->path() }}">{{ $system->site->customer->name }}</a></li>
    <li><a href="{{ $system->site->path() }}">{{ $system->site->name }}</a></li>
    <li><a href="{{ $system->path() }}">{{ $system->name }}</a></li>
    <li>Photo</li>
  </ol>

  <div class="text-center">

    <img
      src="{{ config('constants.PHOTO.url') }}{{ $photo->file_name }}.{{ $photo->ext }}"
      width="100%"
      height="auto"
    >

    <hr>

    <!-- BEGIN CONTROL BUTTONS -->
    <form
      class=""
      action="/systems/photos/{{ $photo->id }}/rotateleft"
      method="post"
      style="display: inline">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="put">
      <button type="submit" class="btn btn-default btn-xs">
        @include('partials.icons.rotate-left-icon')
      </button>
    </form>

    <button type="submit" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateSystemPhotoModal">
      @include('partials.icons.edit-icon')
    </button>
    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#deleteSystemPhotoModal">
      @include('partials.icons.delete-icon')
    </button>

    <form
      class=""
      action="/systems/photos/{{ $photo->id }}/rotateright"
      method="post"
      style="display: inline">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="put">
      <button type="submit" class="btn btn-default btn-xs">
        @include('partials.icons.rotate-right-icon')
      </button>
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

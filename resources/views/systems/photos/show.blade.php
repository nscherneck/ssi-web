@extends('layout')

@section('title', 'SSI-Web | System Photo')

@section('content')

@include('partials.nav')

@include('partials.flash')

<div class="container-fluid">

  <br>
  <ol class="breadcrumb small">
    <li><a href="/customers">Customers</a></li>
    <li><a href="/customer/{{ $system->site->customer->id }}">{{ $system->site->customer->name }}</a></li>
    <li><a href="/site/{{ $system->site->id }}">{{ $system->site->name }}</a></li>
    <li><a href="/system/{{ $system->id }}">{{ $system->name }}</a></li>
    <li>Photo</li>
  </ol>

  <div class="container">
    <br>
    <div class="text-center" id="systemPhotoLarge">
      <img src="https://s3-us-west-2.amazonaws.com/ssiwebstorage/customer-data/system_photos/{{ $photo->file_name }}.{{ $photo->ext }}" width="678px" height="auto"><br><br>
      <p><small>{{ $photo->caption }}</small><br>
      <small><strong>Added By: </strong>{{ $photo->addedBy->first_name }} {{ $photo->addedBy->last_name }}<br>
      <strong>Added: </strong>{{ $photo->created_at->format('l, F j - g:i A') }}<br>
      <strong>Size: </strong>{{ $photo_size }}Mb<br></p>
    </div>

  </div>
</div>

@stop

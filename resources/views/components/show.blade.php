@extends('layout')

@section('title', 'SSI-Extranet | Component')

@section('head')

<style type="text/css">
   body { background: #5F98B9 !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
</style>

@stop

@section('content')

@include('partials.nav')

<div class="container">

  @include('partials.flash')

  <div class="">
    <br>
    <ol class="breadcrumb small">
      <li><a href="/manufacturers">Manufacturers</a></li>
      <li><a href="/manufacturers/{{ $component->manufacturer->id }}">{{ $component->manufacturer->name }}</a></li>
      <li>{{ $component->model }}</li>
    </ol>
  </div>

  <div class="row">

    <div class="col-md-6">

      <div class="panel panel-default">
        <div class="panel-heading">
          General Information
        </div>
        <div class="panel-body">

          @if($component->discontinued === 1)
            <h5><strong>THIS PART HAS BEEN DISCONTINUED BY THE MANUFACTURER</strong></h5>
            <hr>
          @endif

          <p>
            <small>
              {{ $component->description }}
            </small>
          </p>

        </div>

        <div class="panel-footer">

          <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateComponentModal">
            <i class="fa fa-cog"></i></button>

        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">Where It's Installed ({{ $component->systems->count() }})</div>

            <table class="table">
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

    </div>

    <div class="col-md-6">

      <div class="panel panel-default">
        <div class="panel-heading">Documents ({{ $documents->count() }})</div>

          @if($documents->count() > 0)

          <!-- <div class="table-responsive"> -->

            <table class="table">
              <thead>
                <tr>
                  <th><small>File</small></th>
                  <th><small></small></th>
                </tr>
              </thead>
              <tbody>
                @foreach($documents as $document)
                <tr>
                <td width="90%"><small>
                  <a href="https://s3-us-west-2.amazonaws.com/ssiwebstorage/{{ $document->path }}/{{ $document->file_name }}.{{ $document->ext }}" target="blank">
                  {{ $document->file_name }}.{{ $document->ext }}
                  </a>
                </small>
                </td>
                <td width="5%">
                  <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#deleteSystemModal">
                    <i class="fa fa-trash"></i></button>
                </td>
                </tr>
                @endforeach
              </tbody>
            </table>

          <!-- </div> -->

          @endif

          <div class="panel-footer">

            <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addComponentDocumentModal">
              <i class="fa fa-plus"></i></button>
            <br>

          </div>

      </div>

      <div class="panel panel-default">
        <div class="panel-heading">Comments</div>
        <div class="panel-body">

        </div>

        <div class="panel-footer">

          <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addComponentCommentDocumentModal">
            <i class="fa fa-plus"></i></button>
          <br>

        </div>

      </div>

    </div>

  </div>
</div>

@include('partials.modals.edit_component')
@include('partials.modals.add_component_document')

@stop

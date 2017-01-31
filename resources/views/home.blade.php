@extends('layout')

@section('title', 'SSI-Extranet | Home')

@section('content')

@include('partials.nav')

<div class="container-fluid">

  <div class="text-center">
  <h3>Welcome to SSI-Extranet.</h3>
  </div>

  <div class="row">
    <div class="col-md-4 no-gutter-right">

      <div class="titleBar" style="margin-top: 0">
        <p>Recent Photos</p>
      </div>

      @if($recentphotos->count() > 0)

      @foreach($recentphotos as $photo)
        <div class="recentSystemPhoto">

          <div class="recentSystemPhotoThumb">
            <a href="/system/photo/{{ $photo->id }}">
              <img src="https://s3-us-west-2.amazonaws.com/ssiwebstorage/customer-data/system_photos/thumbnails/thumb-{{ $photo->file_name }}.{{ $photo->ext }}" alt="{{ $photo->caption }}" width="150" height="auto"/>
            </a>
          </div>

          <div class="recentSystemPhotoContent">
            <p style="font-size: 12px; line-height: 1.75">
              {{ $photo->caption }}<br>

              <strong>
                <a href="/customer/{{ $photo->getSystem($photo->photoable_id)->site->customer->id }}">
                  {{ $photo->getSystem($photo->photoable_id)->site->customer->name }}
                </a></strong> /

              <strong>
                <a href="/site/{{ $photo->getSystem($photo->photoable_id)->site->id }}">
                  {{ $photo->getSystem($photo->photoable_id)->site->name }}
                </a></strong> /

              <strong>
                <a href="/system/{{ $photo->getSystem($photo->photoable_id)->id }}">
                  {{ $photo->getSystem($photo->photoable_id)->name }}
                </a></strong>

                <br>
              <strong>Added By: </strong>{{ $photo->addedBy->first_name }}<br>
              <strong>Added: </strong>{{ $photo->created_at->setTimezone('America/Los_Angeles')->format('l - F j, g:i A') }}<br>
              <strong>Size: </strong>{{ $photo->getSize() }}<br>
            </p>
          </div>

        </div>
      @endforeach

      @endif
    </div>

    <div class="col-md-4 no-gutter-right">

      <div class="panel panel-info">
        <div class="panel-heading"><small>Recent Component Docs</small></div>

          <table class="table table-condensed">

            <thead>
              <tr>
              </tr>
            </thead>
            <tbody>
              @foreach($recentcomponentdocs as $doc)
              <tr>
                <td>
                  <small>
                    <a href="https://s3-us-west-2.amazonaws.com/ssiwebstorage/{{ $doc->path }}/{{ $doc->file_name }}.{{ $doc->ext }}" target="blank">
                      {{ $doc->file_name }}.{{ $doc->ext }}
                    </a>
                  </small>
                </td>
              </tr>
              @endforeach
            </tbody>

          </table>

      </div> <!-- END OF PANEL -->

    </div>

    <div class="col-md-4">

    </div>

  </div>

</div>



@stop

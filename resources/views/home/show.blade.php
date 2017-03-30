@extends('layout')

@section('title', 'SSI-Extranet | Home')

@section('content')

@include('partials.nav')

<div class="container-fluid">

  @include('partials.flash')
  
  <div class="text-center">
  <h3>Welcome to SSI-Extranet.</h3>
  </div>

  <div class="row">
    <div class="col-lg-8 no-gutter-right">

      <h4>Recent Activity</h4>
      @include('home.activity_feed.feed')



      <div class="titleBar" style="margin-top: 0">
        <p><i class="fa fa-file-text-o" aria-hidden="true"></i> Recently Added Components</p>
      </div>

      <div class="table-responsive">

        <table class="table table-condensed">

          <thead>
            <tr>
            <th>Manufacturer</th>
            <th>Model</th>            
            <th>Description</th>
            <th>Category</th>
            </tr>
          </thead>
          <tbody>
            @foreach($recentcomponents as $component)
            <tr>
              <td>
                <small>
                  <a href="/manufacturer/{{ $component->manufacturer_id }}">
                    {{ $component->manufacturer->name }}
                  </a>
                </small>
              </td>
              <td>
                <small>
                  <a href="/component/{{ $component->id }}">
                    {{ $component->model }}
                  </a>
                </small>
              </td>   
              <td><small>
                @if(strlen($component->description) > 125)
                  @php echo substr($component->description, 0, 125) . '. . .' @endphp
                @else
                  {{ $component->description }}
                @endif
              </small></td>           
              <td>
                <small>
                    {{ $component->component_category->name }}
                </small>
              </td>
            </tr>
            @endforeach
          </tbody>

        </table>

      </div> <!-- END OF RESPONSIVE TABLE -->

    </div>  <!-- END OF COL -->

    <div class="col-lg-4">

      <div class="titleBar" style="margin-top: 0">
        <p><i class="fa fa-camera" aria-hidden="true"></i> Recent Photos</p>
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
                <a href="/customer/{{ $photo->photoable->site->customer->id }}">
                  {{ $photo->photoable->site->customer->name }}
                </a></strong> /

              <strong>
                <a href="/site/{{ $photo->photoable->site->id }}">
                  {{ $photo->photoable->site->name }}
                </a></strong> /

              <strong>
                <a href="/system/{{ $photo->photoable->id }}">
                  {{ $photo->photoable->name }}
                </a></strong>

                <br>
              <strong>Added By: </strong>{{ $photo->addedBy->first_name }}<br>
              <strong>Added: </strong>{{ $photo->created_at->diffForHumans() }}<br>
              <strong>Size: </strong>{{ $photo->getSize() }}<br>
            </p>
          </div>

        </div>
      @endforeach

      @endif

    </div>  <!-- END OF COL -->

  </div> <!-- END OF ROW -->

</div> <!-- END OF CONTAINER -->



@stop

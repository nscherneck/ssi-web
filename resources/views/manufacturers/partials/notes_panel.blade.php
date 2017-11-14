@if ($manufacturer->notes)
  <div class="panel panel-default">
    <div class="panel-heading">
      @include('partials.icons.notes-icon') Notes
    </div>
    <div class="panel-body">
      <small>
      {!! nl2br(e($manufacturer->notes)) !!}
      </small>
    </div> <!-- ./panel-body -->
  </div> <!-- ./panel -->
@endif

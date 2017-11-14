@if (${$model}->notes)
  <div class="panel panel-{{ $color }}">
    <div class="panel-heading">
      @include('partials.icons.notes-icon') Notes
    </div>
    <div class="panel-body">
      <small>
      {!! nl2br(e(${$model}->notes)) !!}
      </small>
    </div>
  </div>
@endif

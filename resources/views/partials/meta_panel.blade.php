<div class="panel panel-{{ $color }}">
  <div class="panel-body">
    <small>
      <strong>Added:</strong> {{ ${$model}->formatted_created_at }}<br>
      <strong>Added By:</strong> {{ ${$model}->addedBy->full_name }}<br>
      @if(${$model}->updated_by)
        <hr>
        <strong>Edited:</strong> {{ ${$model}->formatted_updated_at }}<br>
        <strong>Edited By:</strong> {{ ${$model}->updatedBy->full_name }}<br>
      @endif
    </small>
  </div> <!-- ./panel-body -->
</div> <!-- ./panel -->

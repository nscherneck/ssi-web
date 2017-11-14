<div class="panel panel-default">
  <div class="panel-body">
    <p>
      <small>
        <strong>Added:</strong> {{ $manufacturer->formatted_created_at }}<br>
        <strong>Added By:</strong> {{ $manufacturer->addedBy->full_name }}<br>
        @if($manufacturer->updated_by)
          <hr>
          <strong>Edited:</strong> {{ $manufacturer->formatted_updated_at }}<br>
          <strong>Edited By:</strong> {{ $manufacturer->updatedBy->full_name }}<br>
        @endif
      </small>
    </p>
  </div> <!-- ./panel-body -->
</div> <!-- ./panel -->

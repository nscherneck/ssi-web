<h4>Description</h4>
<p>
  <small>
    {!! nl2br(e($component->description)) !!}
  </small>
</p>

@if($component->notes)
  <br>
  <h4>Notes</h4>
  <p>
    <small>
      {!! nl2br(e($component->notes)) !!}
    </small>
  </p>
@endif

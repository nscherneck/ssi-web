<div class="text-center">
  <h3>
    <strong>{{ $component->manufacturer->name }}</strong>
    {{ $component->model }}
  </h3>
  <p>
    <strong>Category:</strong> {{ $component->componentCategory->name }}
  </p>
  @if($component->discontinued === 1)
    <span class="label label-danger">
      <strong>THIS PART IS OBSOLETE / DISCONTINUED</strong>
    </span>
  @endif
  <hr>
</div>

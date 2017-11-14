<div class="panel panel-primary">
  <div class="panel-heading">
    Components ({{ $components->count() }})
  </div>

  <table class="table table-condensed">
    <thead>
      <tr>
        <th><small><a href="/manufacturer/{{ $manufacturer->id }}?sort=model">Model</a></small></th>
        <th><small>Description</small></th>
        <th><small><a href="/manufacturer/{{ $manufacturer->id }}?sort=component_category_id">Category</a></small></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($components as $component)
        <tr>

        <td width="15%">
        <small>
        <a href="{{ $component->path() }}">
          {{ $component->model }}
        </a>
        </small>
        </td>

        <td width="60%">
        <small>
          {{ $component->formatted_description }}
        </small>
        </td>

        <td width="25%">
        <small>
          {{ $component->componentCategory->name }}
        </small>
        </td>

      </tr>
      @endforeach
    </tbody>
  </table>
</div> <!-- ./panel -->

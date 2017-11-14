<div class="text-center">
  @can('Edit Manufacturer')
    <button type="submit" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateManufacturerModal">
      @include('partials.icons.edit-icon')
    </button>
  @endcan
  @cannot('Edit Manufacturer')
    <button type="submit" class="btn btn-default btn-xs" disabled>
      @include('partials.icons.edit-icon')
    </button>
  @endcannot
  @can('Delete Manufacturer')
    <button type="submit" class="btn btn-default btn-xs" data-toggle="modal" data-target="#deleteManufacturerModal">
      @include('partials.icons.delete-icon')
    </button>
  @endcan
  @cannot('Delete Manufacturer')
    <button type="submit" class="btn btn-default btn-xs" disabled>
      @include('partials.icons.delete-icon')
    </button>
  @endcannot
</div>

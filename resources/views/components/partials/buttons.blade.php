<div class="text-center">
    @can('Edit Component')
      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateComponentModal">
        @include('partials.icons.edit-icon')
      </button>
    @endcan
    @cannot('Edit Component')
      <button type="button" class="btn btn-default btn-xs" disabled>
        @include('partials.icons.edit-icon')
      </button>
    @endcannot
    @can('Delete Component')
      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#deleteComponentModal">
        @include('partials.icons.delete-icon')
      </button>
    @endcan
    @cannot('Delete Component')
      <button type="button" class="btn btn-default btn-xs" disabled>
        @include('partials.icons.delete-icon')
      </button>
    @endcannot
</div>

<div class="panel panel-default">
  <div class="panel-heading">Documents ({{ $documents->count() }})</div>

    @if($documents->count() > 0)

      <table class="table">
        <thead>
          <tr>
            <th><small>File</small></th>
            <th><small></small></th>
          </tr>
        </thead>
        <tbody>
          @foreach($documents as $document)
          <tr>
          <td width="90%">
            <a href="/components/document/{{ $document->id }}" target="_blank">
              <small>
                {{ $document->file_name }}.{{ $document->ext }}
              </small>
            </a>
          </td>
          <td width="5%">
            @can('Delete Component Document')
              <button type="button" class="btn btn-default btn-xs" data-toggle="modal"
                data-target="#delete{{ $document->id }}ComponentDocumentModal">
                  @include('partials.icons.delete-icon')
              </button>
            @endcan
            @cannot('Delete Component Document')
              <button type="button" class="btn btn-default btn-xs" disabled>
                  @include('partials.icons.delete-icon')
              </button>
            @endcannot
          </td>
          </tr>
          @include('partials.modals.delete_component_document')
          @endforeach
        </tbody>
      </table>

    @endif

    <div class="panel-footer">
      
      @can('Create Component Document')
        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addComponentDocumentModal">
          @include('partials.icons.add-icon')
        </button>
      @endcan
      @cannot('Create Component Document')
        <button type="button" class="btn btn-default btn-xs" disabled>
          @include('partials.icons.add-icon')
        </button>
        @endcannot
      <br>

    </div>
</div> <!-- ./panel -->

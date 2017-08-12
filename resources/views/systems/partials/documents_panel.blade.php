    <div id="documents" class="panel panel-info">
      <div class="panel-heading">Documents</div>

        <table class="table">

          <thead>
            <tr>
              <th><small>File</small></th>
              <th><small>Description</small></th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @if(count($documents) > 0)
              @foreach($documents as $document)
                <tr>
                @component('systems.partials.documents_table_row')
                  @slot('document')
                    @include('partials.icons.document-icon')
                    <a href="/systems/document/{{ $document->id }}" target="_blank">
                      <small>
                        {{ $document->fullDocumentName }}
                      </small>
                    </a>
                  @endslot
                  @slot('description')
                    <small>
                      {{ $document->description }}
                    </small>
                  @endslot
                  @slot('editButton')
                    <button
                      class="btn btn-default btn-xs"
                      data-toggle="modal"
                      data-target="#update{{ $document->id }}SystemDocumentModal">
                        @include('partials.icons.edit-icon')
                    </button>
                  @endslot
                  @slot('deleteButton')
                    <button
                      class="btn btn-default btn-xs"
                      data-toggle="modal"
                      data-target="#delete{{ $document->id }}SystemDocumentModal">
                        @include('partials.icons.delete-icon')
                  @endslot
                @endcomponent
                </tr>

                @include('partials.modals.edit_system_document')
                @include('partials.modals.delete_system_document')
              @endforeach
            @endif
          </tbody>

        </table>

        <div class="panel-body">

          <button
            type="button"
            class="btn btn-default btn-xs"
            data-toggle="modal"
            data-target="#addSystemDocumentModal">
              @include('partials.icons.add-icon')
          </button>

        </div>

    </div>

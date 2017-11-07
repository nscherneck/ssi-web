    <div class="panel panel-primary">
      <div class="panel-heading">
        @include('partials.icons.folder-icon')
        Documents
      </div>

        <table class="table">

          <thead>
            <tr>
              <th><small>File</small></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @if(count($test->reports) > 0)
              @foreach($test->reports as $report)
                <tr>
                @component('tests.partials.documents_table_row')
                  @slot('document')
                    @include('partials.icons.document-icon')
                    <a href="/tests/document/{{ $report->id }}/" target="_blank">
                      <small>
                        Report
                      </small>
                    </a>
                  @endslot
                  @slot('description')
                    <small>
                      {{ $report->description }}
                    </small>
                  @endslot
                  @slot('editButton')
                    @can('Edit Test Document')
                      <button
                        class="btn btn-default btn-xs"
                        data-toggle="modal"
                        data-target="#update{{ $report->id }}ReportModal">
                          @include('partials.icons.edit-icon')
                      </button>
                    @endcan
                    @cannot('Edit Test Document')
                      <button
                        class="btn btn-default btn-xs"
                        disabled>
                          @include('partials.icons.edit-icon')
                      </button>
                    @endcannot
                  @endslot
                  @slot('deleteButton')
                    @can('Delete Test Document')
                      <button
                        class="btn btn-default btn-xs"
                        data-toggle="modal"
                        data-target="#delete{{ $report->id }}ReportModal">
                          @include('partials.icons.delete-icon')
                      </button>
                    @endcan
                    @cannot('Delete Test Document')
                      <button
                        class="btn btn-default btn-xs"
                        disabled>
                          @include('partials.icons.delete-icon')
                      </button>
                    @endcannot
                  @endslot
                @endcomponent
                </tr>

                @include('partials.modals.edit_test_document')
                @include('partials.modals.delete_test_document')
              @endforeach
            @endif
          </tbody>

        </table>

        <div class="panel-body">

          @can('Create Test Document')
            <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addReportModal">
              @include('partials.icons.add-icon')
            </button>
          @endcan
          @cannot('Create Test Document')
            <button type="button" class="btn btn-default btn-xs" disabled>
              @include('partials.icons.add-icon')
            </button>
          @endcannot

        </div>

    </div>

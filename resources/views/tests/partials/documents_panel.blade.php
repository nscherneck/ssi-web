    <div class="panel panel-primary">
      <div class="panel-heading">Documents</div>

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
                    <button
                      class="btn btn-default btn-xs"
                      data-toggle="modal"
                      data-target="#update{{ $report->id }}ReportModal">
                        @include('partials.icons.edit-icon')
                    </button>
                  @endslot
                  @slot('deleteButton')
                    <button
                      class="btn btn-default btn-xs"
                      data-toggle="modal"
                      data-target="#delete{{ $report->id }}ReportModal">
                        @include('partials.icons.delete-icon')
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

          <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addReportModal">
            <i class="fa fa-plus"></i></button>

        </div>

    </div>

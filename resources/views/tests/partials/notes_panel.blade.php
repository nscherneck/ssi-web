<div class="panel panel-primary">
  <div class="panel-heading">
    Notes
  </div>

      <table class="table">
        <thead>
          <tr>
            <th><small>Note</small></th>
            <th><small>Added By</small></th>
            <th></th>
            <th></th>
          </tr>
        </thead>

          <tbody>

            @foreach($test->testNotes as $testNote)

              <tr>

                <td width="70%"><small>
                {!! nl2br(e($testNote->note)) !!}
                </small></td>

                <td><small>
                {{ $testNote->addedBy->first_name }}
                </small></td>

                <td>
                  @can('Edit Test Note')
                    <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#update{{ $testNote->id }}testNoteModal">
                      @include('partials.icons.edit-icon')
                    </button>
                  @endcan
                  @cannot('Edit Test Note')
                    <button class="btn btn-default btn-xs" disabled>
                      @include('partials.icons.edit-icon')
                    </button>
                  @endcannot
                </td>

                <td>
                  @can('Delete Test Note')
                    <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#delete{{ $testNote->id }}testNoteModal">
                      @include('partials.icons.delete-icon')
                    </button>
                  @endcan
                  @cannot('Delete Test Note')
                    <button class="btn btn-default btn-xs" disabled>
                      @include('partials.icons.delete-icon')
                    </button>
                  @endcannot
                </td>

              </tr>

              @can('Edit Test Note')
                @include('partials.modals.edit_note')
              @endcan
              @can('Delete Test Note')
                @include('partials.modals.delete_note')
              @endcan

            @endforeach

          </tbody>

      </table>

    <div class="panel-body">

      @can('Create Test Note')
        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addTestNoteModal">
          @include('partials.icons.add-icon')
        </button>
      @endcan
      @cannot('Create Test Note')
        <button type="button" class="btn btn-default btn-xs" disabled>
          @include('partials.icons.add-icon')
        </button>
      @endcannot

    </div> <!-- ./panel-body -->
</div> <!-- ./panel -->

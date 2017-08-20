<div class="panel panel-primary">
  <div class="panel-heading">Notes</div>

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
                  <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#update{{ $testNote->id }}testNoteModal">
                  <i class="fa fa-cog"></i></button>
                </td>

                <td>
                  <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#delete{{ $testNote->id }}testNoteModal">
                  <i class="fa fa-trash-o"></i></button>
                </td>

              </tr>

              @include('partials.modals.edit_note')
              @include('partials.modals.delete_note')

            @endforeach

          </tbody>

      </table>

    <div class="panel-body">

      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addTestNoteModal">
        <i class="fa fa-plus"></i></button>

    </div>

</div>

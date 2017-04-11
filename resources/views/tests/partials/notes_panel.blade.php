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

            @foreach($test->testnotes as $testnote)

              <tr>

                <td width="70%"><small>
                {!! nl2br(e($testnote->note)) !!}
                </small></td>

                <td><small>
                {{ $testnote->addedBy->first_name }}
                </small></td>

                <td>
                  <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#update{{ $testnote->id }}TestnoteModal">
                  <i class="fa fa-cog"></i></button>
                </td>

                <td>
                  <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#delete{{ $testnote->id }}TestnoteModal">
                  <i class="fa fa-trash-o"></i></button>
                </td>

              </tr>

              @include('partials.modals.edit_note')
              @include('partials.modals.delete_note')

            @endforeach

          </tbody>

      </table>

    <div class="panel-body">

      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addTestnoteModal">
        <i class="fa fa-plus"></i></button>

    </div>

</div>

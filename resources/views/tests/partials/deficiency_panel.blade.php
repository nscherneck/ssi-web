<div class="panel panel-primary">
  <div class="panel-heading">Deficiencies</div>

      <table class="table">
        <thead>
          <tr>
            <th><small>Description</small></th>
            <th><small>Added By</small></th>
            <th></th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          @foreach($test->deficiencies as $deficiency)
            <tr>
            <td width="70%"><small>{{ $deficiency->description }}</small></td>
            <td><small>{{ $deficiency->addedBy->first_name }}</small></td>
            <td>
              <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#update{{ $deficiency->id }}DeficiencyModal">
              <i class="fa fa-cog"></i></button>
            </td>
            <td>
              <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#delete{{ $deficiency->id }}DeficiencyModal">
                <i class="fa fa-trash-o"></i></button>
            </td>
          </tr>

          @include('partials.modals.edit_deficiency')
          @include('partials.modals.delete_deficiency')

          @endforeach
        </tbody>

      </table>

    <div class="panel-body">

      <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addDeficiencyModal">
        <i class="fa fa-plus"></i></button>

    </div>

</div>

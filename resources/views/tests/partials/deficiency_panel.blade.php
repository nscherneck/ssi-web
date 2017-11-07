<div class="panel panel-primary">
  <div class="panel-heading">
    Deficiencies
  </div>

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
          @foreach($test->testDeficiencies as $testDeficiency)
            <tr>

            <td width="70%"><small>
            {!! nl2br(e($testDeficiency->description)) !!}
            </small></td>

            <td><small>
            {{ $testDeficiency->addedBy->first_name }}
            </small></td>

            <td>
              @can('Edit Test Deficiency')
                <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#update{{ $testDeficiency->id }}DeficiencyModal">
                  @include('partials.icons.edit-icon')
                </button>
              @endcan
              @cannot('Edit Test Deficiency')
                <button class="btn btn-default btn-xs" disabled>
                  @include('partials.icons.edit-icon')
                </button>
              @endcannot
            </td>

            <td>
              @can('Delete Test Deficiency')
                <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#delete{{ $testDeficiency->id }}DeficiencyModal">
                  @include('partials.icons.delete-icon')
                </button>
              @endcan
              @cannot('Delete Test Deficiency')
                <button class="btn btn-default btn-xs" disabled>
                  @include('partials.icons.delete-icon')
                </button>
              @endcannot
            </td>

          </tr>

          @can('Edit Test Deficiency')
            @include('partials.modals.edit_deficiency')
          @endcan
          @can('Delete Test Deficiency')
            @include('partials.modals.delete_deficiency')
          @endcan

          @endforeach
        </tbody>

      </table>

    <div class="panel-body">

      @can('Create Test Deficiency')
        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addDeficiencyModal">
          @include('partials.icons.add-icon')
        </button>
      @endcan
      @cannot('Create Test Deficiency')
        <button type="button" class="btn btn-default btn-xs" disabled>
          @include('partials.icons.add-icon')
        </button>
      @endcannot

    </div> <!-- ./panel-body -->
</div> <!-- ./panel -->

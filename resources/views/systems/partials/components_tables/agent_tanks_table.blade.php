    <div class="table-responsive">

      <table class="table table-hover table-condensed">
        <thead>
          <tr class="info">
            <th><small>Quantity</small></th>
            <th><small>Name</small></th>
            <th><small>Manufacturer</small></th>
            <th><small>Model</small></th>
            <th><small>Description</small></th>
            <th><small>Category</small></th>
            <th></th>
          </tr>
        </thead>
        <tbody>

          @foreach($system->getComponent(7) as $agentTank)
            @component('systems.partials.components_tables.components_table_row')
              @slot('quantity')
                {{ $agentTank->pivot->quantity }}
              @endslot
              @slot('name')
                {{ $agentTank->pivot->name }}
              @endslot
              @slot('manufacturer')
                <a href="/manufacturer/{{ $agentTank->manufacturer->id }}">
                  {{ $agentTank->manufacturer->name }}
                </a>
              @endslot
              @slot('model')
                <a href="{{ $agentTank->path() }}">
                  {{ $agentTank->model }}
                </a>
              @endslot
              @slot('description')
                {{ $agentTank->formatted_description }}
              @endslot
              @slot('category')
                {{ $agentTank->componentCategory->name }}
              @endslot
              @slot('detach')
                @can('Detach Component')
                  <form
                    action="/system/{{ $system->id }}/component/{{ $agentTank->pivot->id }}/detach"
                    method="post"
                    accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-default btn-xs">
                      @include('partials.icons.delete-icon')
                    </button>
                  </form>
                @endcan
                @cannot('Detach Component')
                  <button class="btn btn-default btn-xs" disabled>
                    @include('partials.icons.delete-icon')
                  </button>
                @endcannot
              @endslot
            @endcomponent
          @endforeach

        </tbody>
      </table>

    </div>

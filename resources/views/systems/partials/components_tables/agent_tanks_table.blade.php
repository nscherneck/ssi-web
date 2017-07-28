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
                <a href="/component/{{ $agentTank->id }}">
                  {{ $agentTank->model }}
                </a>
              @endslot
              @slot('description')
                {{ $agentTank->formatted_description }}
              @endslot
              @slot('category')
                {{ $agentTank->component_category->name }}
              @endslot
              @slot('detach')
                <form 
                  action="/system/{{ $system->id }}/component/{{ $agentTank->pivot->id }}/detach" 
                  method="post" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-default btn-xs">
                    <i class="fa fa-trash-o"></i>
                  </button>
                </form>
              @endslot
            @endcomponent
          @endforeach

        </tbody>
      </table>

    </div>
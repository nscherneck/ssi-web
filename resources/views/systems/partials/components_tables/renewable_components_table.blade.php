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

          @foreach($system->getComponent(5) as $renewable)
            @component('systems.partials.components_tables.components_table_row')
              @slot('quantity')
                {{ $renewable->pivot->quantity }}
              @endslot
              @slot('name')
                {{ $renewable->pivot->name }}
              @endslot
              @slot('manufacturer')
                <a href="/manufacturer/{{ $renewable->manufacturer->id }}">
                  {{ $renewable->manufacturer->name }}
                </a>
              @endslot
              @slot('model')
                <a href="/component/{{ $renewable->id }}">
                  {{ $renewable->model }}
                </a>
              @endslot
              @slot('description')
                {{ $renewable->formatted_description }}
              @endslot
              @slot('category')
                {{ $renewable->component_category->name }}
              @endslot
              @slot('detach')
                <form 
                  action="/system/{{ $system->id }}/component/{{ $renewable->pivot->id }}/detach" 
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
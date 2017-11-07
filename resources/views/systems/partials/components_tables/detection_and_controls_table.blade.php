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

          @foreach($system->getComponent(1) as $panel)
            @component('systems.partials.components_tables.components_table_row')
              @slot('quantity')
                {{ $panel->pivot->quantity }}
              @endslot
              @slot('name')
                {{ $panel->pivot->name }}
              @endslot
              @slot('manufacturer')
                <a href="/manufacturer/{{ $panel->manufacturer->id }}">
                  {{ $panel->manufacturer->name }}
                </a>
              @endslot
              @slot('model')
                <a href="/component/{{ $panel->id }}">
                  {{ $panel->model }}
                </a>
              @endslot
              @slot('description')
                {{ $panel->formatted_description }}
              @endslot
              @slot('category')
                {{ $panel->componentCategory->name }}
              @endslot
              @slot('detach')
                @can('Detach Component')
                  <form
                    action="/systems/{{ $system->id }}/component/{{ $panel->pivot->id }}/detach"
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

          @foreach($system->getComponent(14) as $modularPanel)
            @component('systems.partials.components_tables.components_table_row')
              @slot('quantity')
                {{ $modularPanel->pivot->quantity }}
              @endslot
              @slot('name')
                {{ $modularPanel->pivot->name }}
              @endslot
              @slot('manufacturer')
                <a href="/manufacturer/{{ $modularPanel->manufacturer->id }}">
                  {{ $modularPanel->manufacturer->name }}
                </a>
              @endslot
              @slot('model')
                <a href="/component/{{ $modularPanel->id }}">
                  {{ $modularPanel->model }}
                </a>
              @endslot
              @slot('description')
                {{ $modularPanel->formatted_description }}
              @endslot
              @slot('category')
                {{ $modularPanel->componentCategory->name }}
              @endslot
              @slot('detach')
                @can('Detach Component')
                  <form
                    action="/systems/{{ $system->id }}/component/{{ $modularPanel->pivot->id }}/detach"
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

          @foreach($system->getComponent(2) as $controlEquipment)
            @component('systems.partials.components_tables.components_table_row')
              @slot('quantity')
                {{ $controlEquipment->pivot->quantity }}
              @endslot
              @slot('name')
                {{ $controlEquipment->pivot->name }}
              @endslot
              @slot('manufacturer')
                <a href="/manufacturer/{{ $controlEquipment->manufacturer->id }}">
                  {{ $controlEquipment->manufacturer->name }}
                </a>
              @endslot
              @slot('model')
                <a href="/component/{{ $controlEquipment->id }}">
                  {{ $controlEquipment->model }}
                </a>
              @endslot
              @slot('description')
                {{ $controlEquipment->formatted_description }}
              @endslot
              @slot('category')
                {{ $controlEquipment->componentCategory->name }}
              @endslot
              @slot('detach')
                @can('Detach Component')
                  <form
                    action="/systems/{{ $system->id }}/component/{{ $controlEquipment->pivot->id }}/detach"
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

          @foreach($system->getComponent(13) as $airSamplingDetection)
            @component('systems.partials.components_tables.components_table_row')
              @slot('quantity')
                {{ $airSamplingDetection->pivot->quantity }}
              @endslot
              @slot('name')
                {{ $airSamplingDetection->pivot->name }}
              @endslot
              @slot('manufacturer')
                <a href="/manufacturer/{{ $airSamplingDetection->manufacturer->id }}">
                  {{ $airSamplingDetection->manufacturer->name }}
                </a>
              @endslot
              @slot('model')
                <a href="/component/{{ $airSamplingDetection->id }}">
                  {{ $airSamplingDetection->model }}
                </a>
              @endslot
              @slot('description')
                {{ $airSamplingDetection->formatted_description }}
              @endslot
              @slot('category')
                {{ $airSamplingDetection->componentCategory->name }}
              @endslot
              @slot('detach')
                @can('Detach Component')
                  <form
                    action="/systems/{{ $system->id }}/component/{{ $airSamplingDetection->pivot->id }}/detach"
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

          @foreach($system->getComponent(3) as $detection)
            @component('systems.partials.components_tables.components_table_row')
              @slot('quantity')
                {{ $detection->pivot->quantity }}
              @endslot
              @slot('name')
                {{ $detection->pivot->name }}
              @endslot
              @slot('manufacturer')
                <a href="/manufacturer/{{ $detection->manufacturer->id }}">
                  {{ $detection->manufacturer->name }}
                </a>
              @endslot
              @slot('model')
                <a href="/component/{{ $detection->id }}">
                  {{ $detection->model }}
                </a>
              @endslot
              @slot('description')
                {{ $detection->formatted_description }}
              @endslot
              @slot('category')
                {{ $detection->componentCategory->name }}
              @endslot
              @slot('detach')
                @can('Detach Component')
                  <form
                    action="/systems/{{ $system->id }}/component/{{ $detection->pivot->id }}/detach"
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

          @foreach($system->getComponent(4) as $notification)
            @component('systems.partials.components_tables.components_table_row')
              @slot('quantity')
                {{ $notification->pivot->quantity }}
              @endslot
              @slot('name')
                {{ $notification->pivot->name }}
              @endslot
              @slot('manufacturer')
                <a href="/manufacturer/{{ $notification->manufacturer->id }}">
                  {{ $notification->manufacturer->name }}
                </a>
              @endslot
              @slot('model')
                <a href="/component/{{ $notification->id }}">
                  {{ $notification->model }}
                </a>
              @endslot
              @slot('description')
                {{ $notification->formatted_description }}
              @endslot
              @slot('category')
                {{ $notification->componentCategory->name }}
              @endslot
              @slot('detach')
                @can('Detach Component')
                  <form
                    action="/systems/{{ $system->id }}/component/{{ $notification->pivot->id }}/detach"
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

          @foreach($system->getComponent(15) as $module)
            @component('systems.partials.components_tables.components_table_row')
              @slot('quantity')
                {{ $module->pivot->quantity }}
              @endslot
              @slot('name')
                {{ $module->pivot->name }}
              @endslot
              @slot('manufacturer')
                <a href="/manufacturer/{{ $module->manufacturer->id }}">
                  {{ $module->manufacturer->name }}
                </a>
              @endslot
              @slot('model')
                <a href="/component/{{ $module->id }}">
                  {{ $module->model }}
                </a>
              @endslot
              @slot('description')
                {{ $module->formatted_description }}
              @endslot
              @slot('category')
                {{ $module->componentCategory->name }}
              @endslot
              @slot('detach')
                @can('Detach Component')
                  <form
                    action="/systems/{{ $system->id }}/component/{{ $module->pivot->id }}/detach"
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

          @foreach($system->getComponent(10) as $miscellaneousElectrical)
            @component('systems.partials.components_tables.components_table_row')
              @slot('quantity')
                {{ $miscellaneousElectrical->pivot->quantity }}
              @endslot
              @slot('name')
                {{ $miscellaneousElectrical->pivot->name }}
              @endslot
              @slot('manufacturer')
                <a href="/manufacturer/{{ $miscellaneousElectrical->manufacturer->id }}">
                  {{ $miscellaneousElectrical->manufacturer->name }}
                </a>
              @endslot
              @slot('model')
                <a href="/component/{{ $miscellaneousElectrical->id }}">
                  {{ $miscellaneousElectrical->model }}
                </a>
              @endslot
              @slot('description')
                {{ $miscellaneousElectrical->formatted_description }}
              @endslot
              @slot('category')
                {{ $miscellaneousElectrical->componentCategory->name }}
              @endslot
              @slot('detach')
                @can('Detach Component')
                  <form
                    action="/systems/{{ $system->id }}/component/{{ $miscellaneousElectrical->pivot->id }}/detach"
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

          @foreach($system->getComponent(10) as $miscellaneous)
            @component('systems.partials.components_tables.components_table_row')
              @slot('quantity')
                {{ $miscellaneous->pivot->quantity }}
              @endslot
              @slot('name')
                {{ $miscellaneous->pivot->name }}
              @endslot
              @slot('manufacturer')
                <a href="/manufacturer/{{ $miscellaneous->manufacturer->id }}">
                  {{ $miscellaneous->manufacturer->name }}
                </a>
              @endslot
              @slot('model')
                <a href="/component/{{ $miscellaneous->id }}">
                  {{ $miscellaneous->model }}
                </a>
              @endslot
              @slot('description')
                {{ $miscellaneous->formatted_description }}
              @endslot
              @slot('category')
                {{ $miscellaneous->componentCategory->name }}
              @endslot
              @slot('detach')
                @can('Detach Component')
                  <form
                    action="/systems/{{ $system->id }}/component/{{ $miscellaneous->pivot->id }}/detach"
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

          @foreach($system->getComponent(6) as $accessory)
            @component('systems.partials.components_tables.components_table_row')
              @slot('quantity')
                {{ $accessory->pivot->quantity }}
              @endslot
              @slot('name')
                {{ $accessory->pivot->name }}
              @endslot
              @slot('manufacturer')
                <a href="/manufacturer/{{ $accessory->manufacturer->id }}">
                  {{ $accessory->manufacturer->name }}
                </a>
              @endslot
              @slot('model')
                <a href="/component/{{ $accessory->id }}">
                  {{ $accessory->model }}
                </a>
              @endslot
              @slot('description')
                {{ $accessory->formatted_description }}
              @endslot
              @slot('category')
                {{ $accessory->componentCategory->name }}
              @endslot
              @slot('detach')
                @can('Detach Component')
                  <form
                    action="/systems/{{ $system->id }}/component/{{ $accessory->pivot->id }}/detach"
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

          @foreach($system->getComponent(12) as $uncategorized)
            @component('systems.partials.components_tables.components_table_row')
              @slot('quantity')
                {{ $uncategorized->pivot->quantity }}
              @endslot
              @slot('name')
                {{ $uncategorized->pivot->name }}
              @endslot
              @slot('manufacturer')
                <a href="/manufacturer/{{ $uncategorized->manufacturer->id }}">
                  {{ $uncategorized->manufacturer->name }}
                </a>
              @endslot
              @slot('model')
                <a href="/component/{{ $uncategorized->id }}">
                  {{ $uncategorized->model }}
                </a>
              @endslot
              @slot('description')
                {{ $uncategorized->formatted_description }}
              @endslot
              @slot('category')
                {{ $uncategorized->componentCategory->name }}
              @endslot
              @slot('detach')
                @can('Detach Component')
                  <form
                    action="/systems/{{ $system->id }}/component/{{ $uncategorized->pivot->id }}/detach"
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

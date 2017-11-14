<div class="panel panel-default">
  <div class="panel-heading">Where It's Installed ({{ $component->systems->count() }})</div>

  <table class="table">
    <thead>
      <tr>
        <th><small>Customer</small></th>
        <th><small>Site</small></th>
        <th><small>System</small></th>
      </tr>
    </thead>
    <tbody>
      @foreach($component->systems as $system)
        <tr>
          <td>
            <small>
              <a href="{{ $system->site->customer->path() }}">
                {{ $system->site->customer->name }}
              </a>
            </small>
          </td>
          <td>
            <small>
              <a href="{{ $system->site->path() }}">
                {{ $system->site->name }}
              </a>
            </small>
          </td>
          <td>
            <small>
              <a href="{{ $system->path() }}">
                {{ $system->name }}
              </a>
            </small>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

</div> <!-- ./panel -->

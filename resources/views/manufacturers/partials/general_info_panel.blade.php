<div class="panel panel-default">
  <div class="panel-heading">General Information</div>
  <div class="panel-body">
    <p>
    <small>
      @if ($manufacturer->address1){{ $manufacturer->address1 }}<br>@endif
      @if ($manufacturer->address2){{ $manufacturer->address2 }}<br>@endif
      @if ($manufacturer->city){{ $manufacturer->city }},@endif
      @if ($manufacturer->state_id){{ $manufacturer->state->abbreviated }}@endif @if($manufacturer->zip){{ $manufacturer->zip }}@endif
    </small>
    </p>
    <hr>
    <p>
    <small>
      @if ($manufacturer->phone)
        <strong>Phone:</strong> {{ $manufacturer->phone }}<br>
      @endif
      @if ($manufacturer->fax)
        <strong>Fax:</strong> {{ $manufacturer->fax }}<br>
      @endif
      @if ($manufacturer->web)
        <strong>Website: </strong>
        <a href="{{ $manufacturer->web }}" target="blank">
        {{ $manufacturer->web }}
        </a>
        <br>
      @endif
      @if ($manufacturer->distributor_login)
        <strong>Distributor Website: </strong>
        <a href="{{ $manufacturer->distributor_login }}" target="blank">
        {{ $manufacturer->distributor_login }}
        </a>
        <br>
      @endif
      @if ($manufacturer->email)
        <strong>Email: </strong>
        <a href="mailto:{{ $manufacturer->email }}">
        {{ $manufacturer->email }}
        </a>
      @endif
    </small>
    </p>
    
  </div> <!-- ./panel-body -->
</div> <!-- ./panel -->

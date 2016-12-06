@extends('layout')

@section('title', 'SSI-Web | Sites')

@section('content')

@include('partials.nav')

<div class="container-fluid">

  <h4>All Sites</h4 >

  <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th><a href="{{ $sites->appends(['sort' => 'created_at'])->url($sites->currentPage()) }}"><small>Created</small></a></th>
        <th><a href="{{ $sites->appends(['sort' => 'customer_id'])->url($sites->currentPage()) }}"><small>Customer</small></a></th>
        <th><small>Site</small></th>
        <th><small>Address</small></th>
        <th><a href="{{ $sites->appends(['sort' => 'city'])->url($sites->currentPage()) }}"><small>City</small></a></th>
        <th><a href="{{ $sites->appends(['sort' => 'state_id'])->url($sites->currentPage()) }}"><small>State</small></a></th>
        <th><a href="{{ $sites->appends(['sort' => 'zip'])->url($sites->currentPage()) }}"><small>Zip</small></a></th>
        <th><small>Systems</small></th>
      </tr>
    </thead>
    <tbody>
      @foreach($sites as $site)
        <tr>
        <td><small>{{ $site->created_at->format('D, F j') }}</small></td>
        <td><small><a href="/customer/{{ $site->customer_id }}">{{ $site->customer->name }}</a></small></td>
        <td><small><a href="/site/{{ $site->id }}">{{ $site->name }}</a></small></td>
        <td><small>{{ $site->address1 }}</small></td>
        <td><small>{{ $site->city }}</small></td>
        <td><small>{{ $site->state->abbreviated }}</small></td>
        <td><small>{{ $site->zip }}</small></td>
        <td><small>{{ count($site->systems) }}</small></td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="col-md-12 text-center">

    {{ $sites->appends(['sort' => request('sort', 'created_at')])->links() }}

  </div>


</div>

@stop

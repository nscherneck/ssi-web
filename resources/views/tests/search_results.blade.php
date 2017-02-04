@extends('layout')

@section('title', 'SSI-Extranet | Tests Search Results')

@section('content')

<div class="container-fluid">

  @include('partials.nav')

  <div class="btn-group btn-group-sm" role="group" aria-label="..." style="margin: 10px 0; text-decoration: none;">
    <a href="/customers" style="text-decoration: none;" type="button" class="btn btn-default">Customers Index</a>
    <a href="/sites" style="text-decoration: none;" type="button" class="btn btn-default">Sites Index</a>
  </div>

</div>

<div class="container">

  <div class="titleBar" style="margin-top: 0">
      <p>Tests Search Results</p>
  </div>

  <table class="table table-condensed">
    <thead>
      <tr>
        <th><small>Site Name</small></th>
        <th><small>Test Date</small></th>
        <th><small>-</small></th>
      </tr>
    </thead>
    <tbody>
      @foreach($customer->sites as $site)
        @foreach($site->systems as $system)
          @foreach($system->tests as $test)
            <tr>
              <td><small>{{ $test->system->site->customer->name }} / {{ $test->system->site->name }} / {{ $test->system->name }}</small></td>
              <td><small><a href="/test/{{ $test->id }}">{{ $test->test_date->format('M d Y') }}</a></small></td>
              <td><small></small></td>
            </tr>
          @endforeach
        @endforeach
      @endforeach
    </tbody>
  </table>

</div>

@stop

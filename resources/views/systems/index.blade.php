@extends('layout')

@section('title', 'SSI-Extranet | Systems Lookup')

@section('content')

<div class="container-fluid" style="margin-top: 15px">

  @include('partials.nav')

</div>

<div class="container">

  <div class="titleBar" style="margin-top: 0">
      <p>Systems ({{ $systems->total() }})</p>
  </div>

  <div class="table-responsive">

    <table class="table table-condensed">
    <thead>
      <tr>
        <th><small>Customer</small></th>
        <th><small>Site</small></th>
        <th><small>System</small></th>
        <th><small>Type</small></th>
        <th><small>Last Test</small></th>
        <th><small>Next Test Date</small></th>
        <th><small>Components</small></th>
      </tr>
    </thead>

    <tbody>
      @foreach($systems as $system)
        <tr>

          <td>
            <small>
              <a href="{{ $system->customer->path() }}">
                {{ $system->customer->name }}
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

          <td>
            <small>
              {{ $system->systemType->type }}
            </small>
          </td>

          <td>
            <small>
              {{ $system->getMostRecentTest() }}
            </small>
          </td>

          <td>
            <small>
              {{ $system->formatted_next_test_date }}
            </small>
          </td>

          <td class="text-center">
            <small>
              {{ $system->sumComponents() }}
            </small>
          </td>

        </tr>
      @endforeach
    </tbody>

    </table>
  </div> <!-- END OF RESPONSIVE TABLE -->

  <div class="text-center">
    {{ $systems->links() }}
  </div>


</div> <!-- END OF CONTAINER -->

@stop

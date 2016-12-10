<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Weekly Update</title>
  </head>
  <body>

    <div class="container-fluid text-center">

      <h3>Weekly update from SSI-Web</h3>

      <h4>Systems Due for Testing</h4>

      <ul>
        @foreach($systemduefortest as $system)
          <li>{{ $system->next_test_date->format('F Y') }} | {{ $system->site->customer->name }} - {{ $system->site->name }} - {{ $system->name }}</li>
        @endforeach
      </ul>

      @if($newcustomers->count() > 0)
      <h4>Customers Added Last Week</h4>

      <ul>
        @foreach($newcustomers as $customer)
          <li>{{ $customer->created_at->format('F d, Y') }} | {{ $customer->name }}</li>
        @endforeach
      </ul>
      @endif

      @if($newsites->count() > 0)
      <h4>Sites Added Last Week</h4>

      <ul>
        @foreach($newsites as $site)
          <li>{{ $site->created_at->format('F d, Y') }} | {{ $site->customer->name }} - {{ $site->name }}</li>
        @endforeach
      </ul>
      @endif

      @if($newsystems->count() > 0)
      <h4>Systems Added Last Week</h4>

      <ul>
        @foreach($newsystems as $system)
          <li>{{ $system->created_at->format('F d, Y') }} | {{ $system->site->customer->name }} - {{ $system->site->name }} - {{ $system->name }}</li>
        @endforeach
      </ul>
      @endif

      @if($newtests->count() > 0)
      <h4>Tests Completed Last Week</h4>

      <table cellpadding="10">
        <tr>
          <th>Test Date</th>
          <th>Customer</th>
          <th>Site</th>
          <th>System</th>
          <th>Test Type</th>
        </tr>
        @foreach($newtests as $test)
        <tr>
          <td>{{ $test->test_date->format('F d, Y') }}</td>
          <td>{{ $test->system->site->customer->name }}</td>
          <td>{{ $test->system->site->name }}</td>
          <td>{{ $test->system->name }}</td>
          <td>{{ $test->test_type->name }}</td>
        </tr>
        @endforeach
      </table>
      @endif

    </div>


  </body>
</html>
<br>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Weekly Update from SSI-Extranet</title>
  </head>
  <body>

    <div class="container-fluid text-center">

    @if ($systemsduefortest->count() > 0)
      <h3>Systems Due for Testing</h3>

      <table cellpadding="5">
        <tr>
          <th>Due</th>
          <th>Customer</th>
          <th>Site</th>
          <th>System</th>
        </tr>
        @foreach ($systemsduefortest as $system)
        <tr>
          <td>{{ $system->formatted_next_test_date }}</td>
          <td>{{ $system->site->customer->name }}</td>
          <td>{{ $system->site->name }}</td>
          <td>{{ $system->name }}</td>
        </tr>
        @endforeach
      </table>

    <hr>

    @endif    

    @if ($newcustomers->count() > 0)
      <h3>Customers Added Last Week</h3>

      <table cellpadding="5">
        <tr>
          <th>Created</th>
          <th>Customer</th>
        </tr>
        @foreach ($newcustomers as $customer)
        <tr>
          <td>{{ $customer->formatted_created_at }}</td>
          <td>{{ $customer->name }}</td>
        </tr>
        @endforeach
      </table>

    <hr>

    @endif

    @if ($newsites->count() > 0)
      <h3>Sites Added Last Week</h3>

      <table cellpadding="5">
        <tr>
          <th>Created</th>
          <th>Customer</th>
          <th>Site</th>
        </tr>
        @foreach ($newsites as $site)
        <tr>
          <td>{{ $site->formatted_created_at }}</td>
          <td>{{ $site->customer->name }}</td>
          <td>{{ $site->name }}</td>
        </tr>
        @endforeach
      </table>

    <hr>

    @endif

    @if ($newsystems->count() > 0)
      <h3>Systems Added Last Week</h3>

      <table cellpadding="5">
        <tr>
          <th>Created</th>
          <th>Customer</th>
          <th>Site</th>
          <th>System</th>
        </tr>
        @foreach ($newsystems as $system)
        <tr>
          <td>{{ $system->formatted_created_at }}</td>
          <td>{{ $system->site->customer->name }}</td>
          <td>{{ $system->site->name }}</td>
          <td>{{ $system->name }}</td>
        </tr>
        @endforeach
      </table>

    <hr>

    @endif

    @if ($newtests->count() > 0)
    <h3>Tests Completed Last Week</h3>

    <table cellpadding="5">
      <tr>
        <th>Test Date</th>
        <th>Technician</th>
        <th>Customer</th>
        <th>Site</th>
        <th>System</th>
        <th>Test Type</th>
        <th>Result</th>
      </tr>
      @foreach ($newtests as $test)
      <tr>
        <td>{{ $test->formatted_test_date }}</td>
        <td>{{ $test->technician->first_name }}</td>
        <td>{{ $test->system->site->customer->name }}</td>
        <td>{{ $test->system->site->name }}</td>
        <td>{{ $test->system->name }}</td>
        <td>{{ $test->test_type->name }}</td>
        <td>{{ $test->test_result->name }}</td>
      </tr>
      @endforeach
    </table>
    @endif

    </div>

  </body>
</html>
<br>

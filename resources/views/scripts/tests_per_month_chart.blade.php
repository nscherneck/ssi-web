  <script type="text/javascript">

    var ctx = document.getElementById("myBarChart");

    Chart.defaults.global.legend.display = false;

    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonthsNoOverflow(11)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonthsNoOverflow(10)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonthsNoOverflow(9)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonthsNoOverflow(8)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonthsNoOverflow(7)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonthsNoOverflow(6)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonthsNoOverflow(5)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonthsNoOverflow(4)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonthsNoOverflow(3)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonthsNoOverflow(2)->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->subMonthNoOverflow()->format('F') }}",
              "{{ \Carbon\Carbon::now('America/Los_Angeles')->format('F') }}"
              ],
            datasets: [{
                label: '# of Tests',
                data: [
                  {{ $testsTotalTrailingTwelve[11] }},
                  {{ $testsTotalTrailingTwelve[10] }},
                  {{ $testsTotalTrailingTwelve[9] }},
                  {{ $testsTotalTrailingTwelve[8] }},
                  {{ $testsTotalTrailingTwelve[7] }},
                  {{ $testsTotalTrailingTwelve[6] }},
                  {{ $testsTotalTrailingTwelve[5] }},
                  {{ $testsTotalTrailingTwelve[4] }},
                  {{ $testsTotalTrailingTwelve[3] }},
                  {{ $testsTotalTrailingTwelve[2] }},
                  {{ $testsTotalTrailingTwelve[1] }},
                  {{ $testsTotalTrailingTwelve[0] }}
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });

  </script>

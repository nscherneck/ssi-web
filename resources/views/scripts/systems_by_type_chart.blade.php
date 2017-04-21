  <script type="text/javascript">

function rainbow(numberOfSteps, stepNumber) {
  var r, g, b;
  var h = stepNumber / numberOfSteps;
  var i = ~~(h * 6);
  var f = h * 6 - i;
  var q = 1 - f;
  switch(i % 6){
   case 0: r = 1; g = f; b = 0; break;
   case 1: r = q; g = 1; b = 0; break;
   case 2: r = 0; g = 1; b = f; break;
   case 3: r = 0; g = q; b = 1; break;
   case 4: r = f; g = 0; b = 1; break;
   case 5: r = 1; g = 0; b = q; break;
   }
  var c = "#" + ("00" + (~ ~(r * 255)).toString(16)).slice(-2) + ("00" + (~ ~(g * 255)).toString(16)).slice(-2) + ("00" + (~ ~(b * 255)).toString(16)).slice(-2);
  return (c);
}

  var ctx1 = document.getElementById("myDonutChart");

  Chart.defaults.global.legend.display = false;

  var donutdata = {
    labels: [
      @foreach ($systemTypes as $systemType)
        "{!! $systemType->type !!}",
      @endforeach
    ],
  datasets: [
      {
          data: [
            @foreach ($systemTypes as $systemType)
              {{ $systemType->systems()->count() }},
            @endforeach
          ],
          backgroundColor: [
            @foreach ($systemTypes as $systemType)
              rainbow({!! $systemTypes->count() !!}, {!! $systemType->id !!}),
            @endforeach
          ],
          hoverBackgroundColor: [
            @foreach ($systemTypes as $systemType)
              "#D9EDF7",
            @endforeach
          ]
      }]
  };

  var myDonutChart = new Chart(ctx1, {
    type: 'doughnut',
    data: donutdata,
    options: {
        responsive: true,
      }
  });

  </script>

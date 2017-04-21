  <script type="text/javascript">

  var ctx1 = document.getElementById("myDonutChart");

  Chart.defaults.global.legend.display = false;

  var donutdata = {
    labels: [
      "Fire Alarm",
      "Clean Agent",
      "Inert Gas",
      "Dry Chemical",
      "Wet Chemical",
      "Aerosol",
      "Fire Sprinkler (wet)",
      "Fire Sprinkler (dry)",
      "Fire Sprinkler (preaction)",
      "Fire Sprinkler (deluge)",
      "Fire Sprinkler (foam)",
      "Fire Extinguisher",
      "Low-Pressure CO2",
      "High-Pressure CO2",
      "Air Sampling",
      "High-Expansion Foam",
      "Watermist",
      "Backflow Preventer"
    ],
  datasets: [
      {
          data: [
            {{ $systemsCountByType[0] }},
            {{ $systemsCountByType[1] }},
            {{ $systemsCountByType[2] }},
            {{ $systemsCountByType[3] }},
            {{ $systemsCountByType[4] }},
            {{ $systemsCountByType[5] }},
            {{ $systemsCountByType[6] }},
            {{ $systemsCountByType[7] }},
            {{ $systemsCountByType[8] }},
            {{ $systemsCountByType[9] }},
            {{ $systemsCountByType[10] }},
            {{ $systemsCountByType[11] }},
            {{ $systemsCountByType[12] }},
            {{ $systemsCountByType[13] }},
            {{ $systemsCountByType[14] }},
            {{ $systemsCountByType[15] }},
            {{ $systemsCountByType[16] }},
            {{ $systemsCountByType[17] }}
          ],
          backgroundColor: [
              "#00bfff",
              "#ff0000",
              "#00ff00",
              "#0040ff",
              "#8000ff",
              "#ff0080",
              "#ff8000",
              "#00ff80",
              "#ffff00",
              "#00ffbf",
              "#cc3333",
              "#ffcccc",
              "#ffe6e6",
              "#bfff00",
              "#8000ff",
              "#ff00ff",
              "#bfff00",
              "#0080ff"
          ],
          hoverBackgroundColor: [
              "#00bfff",
              "#ff0000",
              "#00ff00",
              "#0040ff",
              "#8000ff",
              "#ff0080",
              "#ff8000",
              "#00ff80",
              "#ffff00",
              "#00ffbf",
              "#cc3333",
              "#ffcccc",
              "#ffe6e6",
              "#bfff00",
              "#8000ff",
              "#ff00ff",
              "#bfff00",
              "#0080ff"
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

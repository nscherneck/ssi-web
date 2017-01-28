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
            {{ $quantitySystemType[0] }},
            {{ $quantitySystemType[1] }},
            {{ $quantitySystemType[2] }},
            {{ $quantitySystemType[3] }},
            {{ $quantitySystemType[4] }},
            {{ $quantitySystemType[5] }},
            {{ $quantitySystemType[6] }},
            {{ $quantitySystemType[7] }},
            {{ $quantitySystemType[8] }},
            {{ $quantitySystemType[9] }},
            {{ $quantitySystemType[10] }},
            {{ $quantitySystemType[11] }},
            {{ $quantitySystemType[12] }},
            {{ $quantitySystemType[13] }},
            {{ $quantitySystemType[14] }},
            {{ $quantitySystemType[15] }},
            {{ $quantitySystemType[16] }},
            {{ $quantitySystemType[17] }}
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

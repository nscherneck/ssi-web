<div id="map_wrapper" style="height: 280px; padding-bottom: 15px;">
    <div id="map_canvas" class="mapping" style="width: 100%; height: 100%; border: 1px solid black"></div>
</div>

<script>

  jQuery(function($) {
      // Asynchronously Load the map API
      var script = document.createElement('script');
      script.src = "//maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&callback=initialize";
      document.body.appendChild(script);
  });

  function initialize() {
      var map;
      var bounds = new google.maps.LatLngBounds();
      var mapOptions = {
          mapTypeId: 'roadmap'
      };

      // Display a map on the page
      map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
      map.setTilt(45);

      // Multiple Markers
      var markers = [
          @foreach($customer->sites as $site)
            ['{{ $customer->name }} | {{ $site->name }}', {{ $site->lat }}, {{ $site->lon }}],
          @endforeach
      ];

      // Info Window Content
      var infoWindowContent = [
          @foreach($customer->sites as $site)
            ['<div class="info_content">' + '<h5>{{ $customer->name }} | <a href="/site/{{ $site->id }}">{{ $site->name }}</a></h5>' +
            '<p><strong>Systems:</strong> {{ $site->systems->count() }}</p>' +
            '<ul>' +
            @foreach($site->systems as $system)
                '<li><a href="/system/{{ $system->id }}">{{ $system->name }}</a></li>' +
            @endforeach
            '</ul>' +
            '</div>'],
          @endforeach
      ];

      // Display multiple markers on a map
      var infoWindow = new google.maps.InfoWindow(), marker, i;

      // Loop through our array of markers & place each one on the map
      for( i = 0; i < markers.length; i++ ) {
          var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
          bounds.extend(position);
          marker = new google.maps.Marker({
              position: position,
              map: map,
              title: markers[i][0]
          });

          // Allow each marker to have an info window
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
              return function() {
                  infoWindow.setContent(infoWindowContent[i][0]);
                  infoWindow.open(map, marker);
              }
          })(marker, i));

          // Automatically center the map fitting all markers on the screen
          map.fitBounds(bounds);
      }

      // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
      var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
          google.maps.event.removeListener(boundsListener);
      });

  }

</script>

<div id="map" style="width:100%;height:300px;border: 1px solid black"></div>
<script>

function initMap() {

  var map = new google.maps.Map(document.getElementById('map'), {
  zoom: 12,
  center: myLatLng
  });

  var contentString = '<div id="content">'+
    '<div id="siteNotice">'+
    '</div>'+
    '<div id="bodyContent">'+
    '<p><strong>{{ $site->customer->name }} / {{ $site->name }}</strong><br>'+
    '{{ $site->address1 }}<br>' +
    '{{ $site->city }}, {{ $site->state->abbreviated }} {{ $site->zip }}</p>' +
    '</div>'+
    '</div>';

  var infowindow = new google.maps.InfoWindow({
  content: contentString
  });

  var marker = new google.maps.Marker({
  position: myLatLng,
  map: map,
  title: 'Charter Communications / Grants Pass'
  });

  marker.addListener('click', function() {
  infowindow.open(map, marker);
  });
}

</script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key')}}&callback=initMap">
</script>

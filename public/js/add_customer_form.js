
// add customer form

$(document).ready(function() {

var lat = document.getElementById("lat");
var lon = document.getElementById("lon");
lat.value = "45.0000"
lon.value = "-125.0000"

lat.onfocus = function() {
  if (lat.value == "45.0000") {
    lat.value = "";
  }
};

lat.onblur = function() {
  if (lat.value == "") {
    lat.value = "45.0000";
  }
};

lon.onfocus = function() {
  if (lon.value == "-125.0000") {
    lon.value = "";
  }
};

lon.onblur = function() {
  if (lon.value == "") {
    lon.value = "-125.0000";
  }
};


});

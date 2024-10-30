geocoder = new google.maps.Geocoder();

var latAddress = parseFloat(locations[2][lat]);
var lngAddress = parseFloat(locations[2][lng]);
var latlng = new google.maps.LatLng(latAddress, lngAddress);

geocoder.geocode({'latLng': latlng}, function(results, status) {
  if (status == google.maps.GeocoderStatus.OK) {
    if (results[1]) {

     var formattedAddress = results[1].formatted_address;
      

    } else {
      var formattedAddress = results[1].formatted_address;
    }
  } else {
    var formattedAddress = results[1].formatted_address;
  }
('#blog-index').attr("address",formattedAddress);
});
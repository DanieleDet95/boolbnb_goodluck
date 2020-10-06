// include places
var places = require('places.js');

$(document).ready(function() {

  var placesAutocomplete = places({
    appId: 'pl4XRMWU2BCA',
    apiKey: '0c0d759444ce91afdb966e427ac5e837',
    container: document.querySelector('#address')
  });

  placesAutocomplete.on('change', e => (
    $('#latitude').val(e.suggestion['latlng']['lat']),
    $('#longitude').val(e.suggestion['latlng']['lng'])
  ));

})

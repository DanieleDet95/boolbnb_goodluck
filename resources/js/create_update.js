if($('#address_create').length) {
  // include places
  var places = require('places.js');
  var createAutocomplete = places({
    appId: 'pl4XRMWU2BCA',
    apiKey: '0c0d759444ce91afdb966e427ac5e837',
    container: document.querySelector('#address_create')
  });

  createAutocomplete.on('change', e => (
    $('#latitude').val(e.suggestion['latlng']['lat']),
    $('#longitude').val(e.suggestion['latlng']['lng'])
  ));
}

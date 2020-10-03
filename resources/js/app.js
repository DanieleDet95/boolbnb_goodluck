// include Bootstrap
require('./bootstrap');

// include JQuery
var $ = require( "jquery" );

$(document).ready(function() {
  $('input[type="checkbox"]').prop('checked', false);

  $('input[type="checkbox"]').on('click', function(event) {
    checked($(this));
  })

  // search-bar algolia
  var places = require('places.js');
  var placesAutocomplete = places({
    appId: 'pl4XRMWU2BCA',
    apiKey: '0c0d759444ce91afdb966e427ac5e837',
    container: document.querySelector('#address-input')
  });

  placesAutocomplete.on('change', e => (
    $('#latitude').val(e.suggestion['latlng']['lat']),
    $('#longitude').val(e.suggestion['latlng']['lng'])
  ));

  $('#submit').on('click', function() {

    var params = {
      beds: $('#beds').val(),
      rooms: $('#rooms').val(),
      baths: $('#baths').val(),
      square_m: $('#square_m').val(),
      price: $('#price').val(),
      pool: $('#pool').val(),
      wifi: $('#wifi').val(),
      pet: $('#pet').val(),
      parking: $('#parking').val(),
      piano: $('#piano').val(),
      sauna: $('#sauna').val(),
      latitude: $('#latitude').val(),
      longitude: $('#longitude').val()
    }

    callAjax(params);

  });

})


// definitions

function checked(event) {
  if($(event).prop('checked')) {
    $(event).val('true');
  }else{
    $(event).val('false');
  }
}



function callAjax(params) {

  $.ajax
  ({
    url: "http://boolbnb_goodluck.loc/api/search",

    method: "GET",

    data: {
            beds: params.beds,
            rooms: params.rooms,
            baths: params.baths,
            square_m: params.square_m,
            price: params.price,
            pool: params.pool,
            wifi: params.wifi,
            pet: params.pet,
            parking: params.parking,
            piano: params.piano,
            sauna: params.sauna,
            latitude: params.latitude,
            longitude: params.longitude,
          },

    success: function(dataResponse){
      console.log(dataResponse);
    },

    error: function(error) {
      console.log(error);
    }
  });
}

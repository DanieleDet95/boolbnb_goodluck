const Handlebars = require("handlebars");

$(document).ready(function() {
  // erase all values from all inputs in .search-wrapper except for #submit
  $(".search-wrapper input:not('#submit')").val('');
  // set all checkboxes value as false
  $('input[type="checkbox"]').prop('checked', false);

  // toggle chechbox values on click
  $('input[type="checkbox"]').on('click', function(event) {
    checked($(this));
  })

  // set algolia search-bar autocomplete
  var places = require('places.js');
  var placesAutocomplete = places({
    appId: 'pl4XRMWU2BCA',
    apiKey: '0c0d759444ce91afdb966e427ac5e837',
    container: document.querySelector('#address-input')
  });

  // take lat/lng value from algolia's response and store them into data-att of #adress-input
  placesAutocomplete.on('change', e => (
    $('#address-input').attr('data-lat', e.suggestion['latlng']['lat']),
    $('#address-input').attr('data-lng',e.suggestion['latlng']['lng'])
  ));

  // on click take all values from the form and store them into params object
  $('#submit').on('click', function() {

    var params = {
      range: $('#range').val(),
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
      latitude: $('#address-input').attr('data-lat'),
      longitude: $('#address-input').attr('data-lng')
    }

    // send params to API in Api/SearchController
    ajaxCall(params);

  });

})

// DEFINITIONs

function checked(event) {
  if($(event).prop('checked')) {
    $(event).val('true');
  }else{
    $(event).val('false');
  }
}



function ajaxCall(params) {

  $.ajax
  ({
    url: "http://boolbnb_goodluck.loc/api/search",

    method: "GET",

    data: {
            range: params.range,
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

    success: function(suites){
      var source = $('#suite-cards-template').html();
      var template = Handlebars.compile(source);

      for (var i = 0; i < suites.length; i++) {
        var suite = suites[i];
        var html = template(suite);
        $('.suites-cards').append(html);
      }
    },

    error: function(error) {
      console.log(error);
    }
  });
}

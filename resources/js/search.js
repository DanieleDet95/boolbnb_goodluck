const Handlebars = require("handlebars");

$(document).ready(function() {
  // erase all values from all inputs in .search-wrapper except for #submit
  $(".input_box input:not('#submit')").val('');
  // set all checkboxes value as false
  $('input[type="checkbox"]').prop('checked', false);

  // toggle chechbox values on click
  $('input[type="checkbox"]').on('click', function(event) {
    checked($(this));
  })

  // set map
  var mymap = L.map('map', {
    scrollWheelZoom: true,
    zoomControl: true
  });

  // set methods
  L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    minZoom: 1,
    maxZoom: 50,
  }).addTo(mymap);

  // set the view
  mymap.setView([41.90, 12.47], 10);

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
    // url: "http://127.0.0.1:8000/api/search", //per i comuni mortali

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
      // console.log(suites);
      var source = $('#suite-cards-template').html();
      var template = Handlebars.compile(source);

      // refresh html before a new search
      $('.suites_cards_promo').html('');

      // console.log(suites.noPromo);

      var maPins = []

      for (var i = 0; i < suites.promo.length; i++) {

        var suite = suites.promo[i];

        // set an array of pins
        var pin = {}

        // set pin
        pin.lat = suite.latitude;
        pin.lng = suite.longitude;
        pin.title = suite.title;
        // push pin into the array
        maPins.push(pin);

        // set html with handlebars
        var html = template(suite);
        $('.suites_cards_promo').append(html);
      }

      $('.suites_cards_noPromo').html('');

      for (var i = 0; i < suites.noPromo.length; i++) {

        // set an array of pins
        var pin = {}
        var suite = suites.noPromo[i];

        // set pin
        pin.lat = suite.latitude;
        pin.lng = suite.longitude;
        pin.title = suite.title;
        // push pin into the array
        maPins.push(pin);

        // set html with handlebars
        var html = template(suite);
        $('.suites_cards_noPromo').append(html);
      }

        loadMap(maPins);

    },

    error: function(error) {
      console.log(error);
    }
  });
}

function loadMap(maPins) {

  // // refresh map
  $('#map').remove();
  $('.my_maps').html('<div id="map" style="height:250px"></div>');

  // take values from searchbar
  var latlng = {
    lat: $('#address-input').attr('data-lat'),
    lng: $('#address-input').attr('data-lng')
  };

  // set map
  var mymap = L.map('map', {
    scrollWheelZoom: true,
    zoomControl: true
  });

  // set methods
  L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    minZoom: 1,
    maxZoom: 50,
  }).addTo(mymap);

  // loop all pins and pins to the map
  for (var i = 0; i < maPins.length; i++) {
    var pin = maPins[i];
    pinSuiteToMap(pin, mymap);
  }

  // set the view
  mymap.setView([latlng.lat, latlng.lng], 8);

}

function pinSuiteToMap(pin, mymap) {
  L.marker([pin.lat, pin.lng]).bindPopup(pin.title).openPopup().addTo(mymap);
}

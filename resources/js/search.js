/*
###########################
###########################

check if home is on screen

###########################
###########################
*/

// include handlebars
const Handlebars = require("handlebars");

if($('#home_search').length){
    // refresh value 0
    $('#home_search').val('');
    $('#key').val('');
    $('#latitude').val('');
    $('#longitude').val('');

    // set algolia autocompleate
    var places = require('places.js');
    var homeAutocomplete = places({
      appId: 'pl4XRMWU2BCA',
      apiKey: '0c0d759444ce91afdb966e427ac5e837',
      container: document.querySelector('#home_search'),
      style:false
    })

    homeAutocomplete.on('change', e => (
      $('#key').val(e.suggestion.value),
      $('#latitude').val(e.suggestion['latlng']['lat']),
      $('#longitude').val(e.suggestion['latlng']['lng'])
    ))
  }





/*
############################
############################

check if search is on screen

############################
############################
*/

if($('#address_input').length) {
  // check a previous search from home

  // console.log($('#address_input').attr('data-lat') && $('#address_input').attr('data-lng'));
  if ($('#address_input').attr('data-lat') && $('#address_input').attr('data-lng')) {
    $('#range').val(20);  //set a default range

    var params = {
      latitude: $('#address_input').attr('data-lat'),
      longitude: $('#address_input').attr('data-lng'),
      range: $('#range').val()
    }

    console.log(params);
    ajaxCall(params);

  } else {

    // erase all values from all inputs in .search-wrapper except for #submit
    $("#search_box input:not('#submit')").val('');
  }

// **DEFAULT INPUT VALUE**
// set all checkboxes value as false
$('input[type="checkbox"]').prop('checked', false);

// toggle chechbox values on click
$('#search_box input[type="checkbox"]').on('click', function(event) {
  checked($(this));
})


/*
**********************
MAP LEAFLEAT
**********************
*/

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
mymap.setView([42.455111, 12.512467], 6);


/*
**********************
ALGOLIA AUTOCOMPLEATE
**********************
*/

var places = require('places.js');
var placesAutocomplete = places({
  appId: 'pl4XRMWU2BCA',
  apiKey: '0c0d759444ce91afdb966e427ac5e837',
  container: document.querySelector('#address_input'),
  // style:false
});

// take lat/lng value from algolia's response and store them into data-att of #adress-input
placesAutocomplete.on('change', e => (
  $('#address_input').attr('data-lat', e.suggestion['latlng']['lat']),
  $('#address_input').attr('data-lng',e.suggestion['latlng']['lng'])
));

/*
**********************
SEARCH FUNCTION
**********************
*/
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
    latitude: $('#address_input').attr('data-lat'),
    longitude: $('#address_input').attr('data-lng')
  }

  console.log(params);
  // send params to API in Api/SearchController
  ajaxCall(params);


});

$('#searchbar-wrapper input').on('keypress', function(e) {
  if (e.keyCode === 13) {

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
      latitude: $('#address_input').attr('data-lat'),
      longitude: $('#address_input').attr('data-lng')
    }

    console.log(params);
    // send params to API in Api/SearchController
    ajaxCall(params);



    }
  })


} // close the search-on-screen block





// DEFINITIONs

// search call
function ajaxCall(params) {

  $body = $("body");

  $(document).on({
    ajaxStart: function() {
      $body.addClass("loading");
    },
     ajaxStop: function() {
       $body.removeClass("loading");
     }
  });

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
      console.log(suites);
      var source = $('#suite-cards-template').html();
      var template = Handlebars.compile(source);

      // refresh html before a new search
      $('.suites_cards_promo').html('');

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

// load the map
function loadMap(maPins) {

  // // refresh map
  $('#map').remove();
  $('.my_maps').html('<div id="map"></div>');

  // take values from searchbar
  var latlng = {
    lat: $('#address_input').attr('data-lat'),
    lng: $('#address_input').attr('data-lng')
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
  mymap.setView([latlng.lat, latlng.lng], 14);

}

// attach pins to the map
function pinSuiteToMap(pin, mymap) {
  L.marker([pin.lat, pin.lng]).bindPopup(pin.title).openPopup().addTo(mymap);
}

// toggle checkbox values
function checked(event) {
  if($(event).prop('checked')) {
    $(event).val('true');
  }else{
    $(event).val('false');
  }
}

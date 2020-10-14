// include handlebars
const Handlebars = require("handlebars");

/*
*-..-*-..-*-..-*
  set Algolia
*-..-*-..-*-..-*
*/
if($('#algolia_input').length)
{
  // erase values after home refresh
  if($('.form_search_bar').length)
  {
    $('#algolia_input').val('');
    $('#key').val('');
    $('#latitude').val('');
    $('#longitude').val('');
  }

  var places = require('places.js');
  var searchAutocomplete = places
  ({
    appId: 'pl4XRMWU2BCA',
    apiKey: '0c0d759444ce91afdb966e427ac5e837',
    container: document.querySelector('#algolia_input'),
    style:($('.form_search_bar').length) ? false : true
  })

  searchAutocomplete.on('change', e =>
  (
    ($('.form_search_bar').length) ? $('#key').val(e.suggestion.value) : null,
    ($('.form_search_bar').length) ? $('#latitude').val(e.suggestion['latlng']['lat']) : $('#algolia_input').attr('data-lat', e.suggestion['latlng']['lat']),
    ($('.form_search_bar').length) ? $('#longitude').val(e.suggestion['latlng']['lng']) : $('#algolia_input').attr('data-lng',e.suggestion['latlng']['lng'])
  ))

}



/*
*-..-*-..-*-..-*-..-*-..-*-..-*
  check if search is on screen
*-..-*-..-*-..-*-..-*-..-*-..-*
*/

// erase session storage on click
$('#navbarNav a').on('click', function()
{
  sessionStorage.removeItem('data');
})

if($('#search_wrapper').length) {

  // check a previous search from home
  if ($('#algolia_input').attr('data-lat') && $('#algolia_input').attr('data-lng'))
  {

    var params = setParams();
    ajaxCall(params);

  }
  // check if a previous search is stored
  else if (sessionStorage.data)
  {

    var response = JSON.parse(sessionStorage.data);
    success(response);

  }
  // erase all values from all inputs in #search_wrapper except for #submit
  else
  {

    $("#search_wrapper input:not('#submit')").val('');

  }

  // set checkbox as false
  $('input[type="checkbox"]').prop('checked', false);

  // toggle chechbox on click
  $('.checkbox input[type="checkbox"]').on('click', function(event)
  {
    checked($(this));
  })



  // search on click
  $('#submit').on('click', function()
  {

    var params = setParams();
    // send params to API in Api/SearchController
    ajaxCall(params);

  });

  // search on keypress
  $('#search_wrapper input').on('keypress', function(e)
  {
    if (e.keyCode === 13) {

      var params = setParams();
      // send params to API in Api/SearchController
      ajaxCall(params);

    }
  })
}






/*
*-..-*-..-*-..-*-..-*-..-*-..-*
        DEFINITIONs
*-..-*-..-*-..-*-..-*-..-*-..-*
*/



// ajax call
function ajaxCall(params)
{

  $body = $(".main_wrapper_search");

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
    // url: "http://boolbnb_goodluck.loc/api/search",
    url: "http://127.0.0.1:8000/api/search", //per i comuni mortali

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

    success: function(suites)
    {
      // store results in sessionStorage
      sessionStorage.setItem('data', JSON.stringify(suites));
      success(suites)


    },

    error: function(error) {
      console.log(error);
    }
  });
}



// append cards and map
function success(suites) {
  var map_pins = [];
  var range = $('#range').val() ? $('#range').val() : 20;
  var source = $('#suite-cards-template').html();
  var template = Handlebars.compile(source);

  // refresh html before a new search
  $('.suites_cards_promo').html('');

  for (var i = 0; i < suites.promo.length; i++)
  {

    var suite = suites.promo[i];

    // set an array of pins
    var pin = {}

    // set pin
    pin.lat = suite.latitude;
    pin.lng = suite.longitude;
    pin.title = suite.title;
    // push pin into the array
    map_pins.push(pin);

    // set html with handlebars
    var html = template(suite);
    $('.suites_cards_promo').append(html);
  }

  $('.suites_cards_noPromo').html('');

  for (var i = 0; i < suites.noPromo.length; i++)
  {

    // set an array of pins
    var pin = {}
    var suite = suites.noPromo[i];

    // set pin
    pin.lat = suite.latitude;
    pin.lng = suite.longitude;
    pin.title = suite.title;
    // push pin into the array
    map_pins.push(pin);

    // set html with handlebars
    var html = template(suite);
    $('.suites_cards_noPromo').append(html);

  }

    loadMap(map_pins, range);
}



// load the map
function loadMap(map_pins, range)
{

  // // refresh map
  $('#map').remove();
  $('.my_maps').html('<div id="map"></div>');

  // take values from searchbar
  var latlng =
  {
    lat: $('#algolia_input').attr('data-lat'),
    lng: $('#algolia_input').attr('data-lng')
  };

  // set map
  var mymap = L.map('map',
  {
    scrollWheelZoom: true,
    zoomControl: true
  });

  L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    {
    minZoom: 1,
    maxZoom: 50,
    }).addTo(mymap);

  // loop all pins
  for (var i = 0; i < map_pins.length; i++)
  {

    var pin = map_pins[i];
    pinSuiteToMap(pin, mymap);

  }

  // set the view
  if(range <= 5) {
    mymap.setView([latlng.lat, latlng.lng], 12.5);
  } else if (range <= 20) {
    mymap.setView([latlng.lat, latlng.lng], 11.25);
  } else {
    mymap.setView([latlng.lat, latlng.lng], 10);
  }

}



// attach pins to the map
function pinSuiteToMap(pin, mymap)
{

  L.marker([pin.lat, pin.lng]).bindPopup(pin.title).openPopup().addTo(mymap);

}



// set params
function setParams()
{

  return {
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
    latitude: $('#algolia_input').attr('data-lat'),
    longitude: $('#algolia_input').attr('data-lng')
  }

}



// toggle checkbox values
function checked(event)
{

  if($(event).prop('checked'))
  {
    $(event).val('true');
  }
  else
  {
    $(event).val('false');
  }

}

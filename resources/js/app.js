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


// definition

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



// var ctx = document.getElementById('bar_visual').getContext('2d');
// var myChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno','Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
//         datasets: [{
//             label: '# Visualizzazioni',
//             data: [12, 19, 3, 5, 2, 3],
//             backgroundColor: [
//                 'rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)',
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: true,
//                 }
//             }]
//         }
//     }
// });
//
//
// var ctx = document.getElementById('line_visual');
// var myChart = new Chart(ctx, {
//     type: 'line',
//     data: {
//         labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno','Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
//         datasets: [{
//             label: '# Visualizzazioni',
//             data: [12, 19, 3, 5, 2, 3],
//             backgroundColor: [
//                 'rgba(255,255,255, 0.3)',
//             ],
//             borderColor: [
//                 'rgba(255, 0, 0, 1)',
//             ],
//             borderWidth: 1,
//             lineTension: 0
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: true
//                 }
//             }]
//         }
//     }
// });
//
// var ctx = document.getElementById('line_message');
// var myChart = new Chart(ctx, {
//     type: 'line',
//     data: {
//         labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno','Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
//         datasets: [{
//             label: '# Messaggi',
//             data: [12, 19, 3, 5, 2, 3],
//             backgroundColor: [
//                 'rgba(255,255,255, 0.3)',
//             ],
//             borderColor: [
//                 'rgba(255, 0, 0, 1)',
//             ],
//             borderWidth: 1,
//             lineTension: 0
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: true
//                 }
//             }]
//         }
//     }
// });
//
// var ctx = document.getElementById('bar_message').getContext('2d');
// var myChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno','Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
//         datasets: [{
//             label: '# Messaggi',
//             data: [12, 19, 3, 5, 2, 3],
//             backgroundColor: [
//                 'rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)',
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: true
//                 }
//             }]
//         }
//     }
// });

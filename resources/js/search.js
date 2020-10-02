// // include Bootstrap
// require('./bootstrap');
//
// // include JQuery
// var $ = require( "jquery" );
//
// // search-bar algolia
// var places = require('places.js');
// var placesAutocomplete = places({
//   appId: 'pl4XRMWU2BCA',
//   apiKey: '0c0d759444ce91afdb966e427ac5e837',
//   container: document.querySelector('#address-input')
// });
//
// placesAutocomplete.on('change', e => (
//   $('#latitude').val(e.suggestion['latlng']['lat']),
//   $('#longitude').val(e.suggestion['latlng']['lng'])
// ));
//
// $('#longitude').val(33);
//
// $('#submit').click(function() {
//
//   var latitude = $('#latitude').val();
//   var longitude = $('#longitude').val();
//
//   callAjax(latitude, longitude)
//
// });
//
// function callAjax(latitude, longitude) {
//   $.ajax
//   ({
//     url: "http://boolbnb.loc/api/search?",
//
//     method: "GET",
//
//     data: {
//             longitude: longitude,
//             latitude: latitude
//           },
//
//     success: function(dataResponse){
//       console.log(dataResponse);
//     },
//
//     error: function(error) {
//       console.log(error);
//     }
//   });
// }

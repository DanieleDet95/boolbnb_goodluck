// include Bootstrap
require('./bootstrap');
// include JQuery
var $ = require( "jquery" );
// include places
var places = require('places.js');

$(document).ready(function() {
  // include commons
  require('./partials/commons');
  // include searchbar functions
  require('./partials/search');
  // include Statistiche
  require('./partials/static');
  // include create
  require('./partials/create_update');
})

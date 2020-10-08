// include Bootstrap
require('./bootstrap');
// include JQuery
var $ = require( "jquery" );
// include places
var places = require('places.js');

$(document).ready(function() {
  // include commons
  require('./commons');
  // include searchbar functions
  require('./search');
  // include Statistiche
  require('./static');
  // include create
  require('./create_update');
})

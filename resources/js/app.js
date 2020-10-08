// include Bootstrap
require('./bootstrap');
// include JQuery
var $ = require( "jquery" );
// include handlebars
const Handlebars = require("handlebars");
// include places
var places = require('places.js');

$(document).ready(function() {
  console.log('ready');
  // include searchbar functions
  require('./search');
  // include Statistiche
  require('./static');
  // include create
  require('./create_update');
  // include commons
  require('./commons');

})

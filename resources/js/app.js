// include Bootstrap
require('./bootstrap');
// include JQuery
var $ = require( "jquery" );

$(document).ready(function() {
  // include commons
  require('./commons');
  // include searchbar functions
  require('./search');
  // include Statistiche
  require('./static');
  // include create
  require('./create_update');
  // include create
  require('./show');
  // include avviso messagges
  require('./avviso');
})

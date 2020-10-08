// include Bootstrap
require('./bootstrap');
// include JQuery
var $ = require( "jquery" );
// include handlebars
const Handlebars = require("handlebars");
// include searchbar functions
require('./search');
// include Statistiche
require('./static');

// Create suites file main_image upload
$('#create_main_image').on('change', function() {
$('.custom-file-label').text("File Loaded")
});

if($('#show_map').length) {
  var lat = $('#show_map').attr('data-lat');
  var lng = $('#show_map').attr('data-lng');
  var showMap = L.map('show_map').setView([lat, lng], 13);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    minZoom:5
  }).addTo(showMap);

  L.marker([lat, lng]).addTo(showMap);

}

// include JQuery
var $ = require( "jquery" );

$( document ).ready(function() {

  printStatics();

  function printStatics(){
    console.log($('#suite').text());
    $.ajax({
        url: 'http://127.0.0.1:8000/api/statics',
        data: {
            apartment: $('#suite').text(),
        },
        method: 'GET',
        success: function(dataResponse) {
            dd(dataResponse);
            // var gennaio = dataResponse.gennaio.length;
            // var febbraio = dataResponse.febbraio.length;
            // var marzo = dataResponse.marzo.length;
            // var aprile = dataResponse.aprile.length;
            // var maggio = dataResponse.maggio.length;
            // var giugno = dataResponse.giugno.length;
            // var luglio = dataResponse.luglio.length;
            // var agosto = dataResponse.agosto.length;
            // var settembre = dataResponse.settembre.length;
            // var ottobre = dataResponse.ottobre.length;
            // var novembre = dataResponse.novembre.length;
            // var dicembre = dataResponse.dicembre.length;
            //
            //
            // var monthsStats = [gennaio, febbraio, marzo, aprile, maggio, giugno, luglio, agosto, settembre, ottobre, novembre, dicembre];
            // var months = ["gennaio", "febbraio", "marzo", "aprile", "maggio", "giugno", "luglio", "agosto", "settembre", "ottobre", "novembre", "dicembre"];
            //
            // var today = new Date();
            // var aMonth = today.getMonth();
            // var arrayMesiDaPassare =[];
            // var arrayValoriDaPassare =[];
            //
            //
            // for (var i = 0; i < numeroMesiDaVisualizzare; i++) {
            //   arrayMesiDaPassare.push(months[aMonth]);
            //   arrayValoriDaPassare.push(monthsStats[aMonth]);
            //   aMonth = aMonth - 1;
            //   if (aMonth == -1) {
            //     aMonth = 11;
            //   }
            // }

            var ctx = document.getElementById('bar_visual').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno','Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                    datasets: [{
                        label: '# Visualizzazioni',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                            }
                        }]
                    }
                }
            });

            var ctx = document.getElementById('bar_message').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno','Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                    datasets: [{
                        label: '# Messaggi',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

        },
        error: function error() {
            alert('error');
        }
    });
  }

});

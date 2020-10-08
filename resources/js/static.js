$( document ).ready(function() {

  printStatics();

  function printStatics(){
    $.ajax({
        url: "http://boolbnb_goodluck.loc/api/statics",
        // url: 'http://127.0.0.1:8000/api/statics', //per i comuni mortali
        data: {
            suite: $('#suite').text(),
        },
        method: 'GET',
        success: function(dataResponse) {

            $('#vis_totali').html(dataResponse.v_totale);
            $('#mess_totali').html(dataResponse.m_totale);

            var m_gennaio = dataResponse.m_gennaio;
            var m_febbraio = dataResponse.m_febbraio;
            var m_marzo = dataResponse.m_marzo;
            var m_aprile = dataResponse.m_aprile;
            var m_maggio = dataResponse.m_maggio;
            var m_giugno = dataResponse.m_giugno;
            var m_luglio = dataResponse.m_luglio;
            var m_agosto = dataResponse.m_agosto;
            var m_settembre = dataResponse.m_settembre;
            var m_ottobre = dataResponse.m_ottobre;
            var m_novembre = dataResponse.m_novembre;
            var m_dicembre = dataResponse.m_dicembre;

            var v_gennaio = dataResponse.v_gennaio;
            var v_febbraio = dataResponse.v_febbraio;
            var v_marzo = dataResponse.v_marzo;
            var v_aprile = dataResponse.v_aprile;
            var v_maggio = dataResponse.v_maggio;
            var v_giugno = dataResponse.v_giugno;
            var v_luglio = dataResponse.v_luglio;
            var v_agosto = dataResponse.v_agosto;
            var v_settembre = dataResponse.v_settembre;
            var v_ottobre = dataResponse.v_ottobre;
            var v_novembre = dataResponse.v_novembre;
            var v_dicembre = dataResponse.v_dicembrev

            var ctx = document.getElementById('bar_visual').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno','Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                    datasets: [{
                        label: '# Visualizzazioni',
                        data: [v_gennaio, v_febbraio, v_marzo, v_aprile, v_maggio, v_giugno, v_luglio, v_agosto, v_settembre, v_ottobre, v_novembre, v_dicembre],
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
                        data: [m_gennaio, m_febbraio, m_marzo, m_aprile, m_maggio, m_giugno, m_luglio, m_agosto, m_settembre, m_ottobre, m_novembre, m_dicembre],
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

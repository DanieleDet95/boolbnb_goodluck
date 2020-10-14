<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Suite;
use App\Message;
use App\Visit;
use Carbon\Carbon;

class StaticController extends Controller
{
  public function index(Request $request) {

    // ////////////////////////////////////// MESSAGGI /////////////////////////////////////////////

    // Inizializzazione array dei mesi per messaggi
    $gennaio_m=[];$febbraio_m=[];$marzo_m=[];$aprile_m=[];$maggio_m=[];$giugno_m=[];$luglio_m=[];$agosto_m=[];$settembre_m=[];$ottobre_m=[];$novembre_m=[];$dicembre_m=[];

    // Creazione variabile con tutti i messaggi
    $messages = Message::all();

    // Ricavare id della suite
    $id = $request->get('suite');

    // Filtrare per tutti i messaggi presenti sul database
    foreach ($messages as $message) {

      // Se l'id della suite combacia con l'id della suite del messaggio per ogni mese aggiungere il messaggio
      if ($id == $message->suite->id) {

        if ($message['created_at']->format('m') == '01') {
          $gennaio_m[$id][]= $message;
        }elseif ($message['created_at']->format('m') == '02') {
          $febbraio_m[$id][]= $message;
        }elseif ($message['created_at']->format('m') == '03') {
          $marzo_m[$id][]= $message;
        }elseif ($message['created_at']->format('m') == '04') {
          $aprile_m[$id][]= $message;
        }elseif ($message['created_at']->format('m') == '05') {
          $maggio_m[$id][]= $message;
        }elseif ($message['created_at']->format('m') == '06') {
          $giugno_m[$id][]= $message;
        }elseif ($message['created_at']->format('m') == '07') {
          $luglio_m[$id][]= $message;
        }elseif ($message['created_at']->format('m') == '08') {
          $agosto_m[$id][]= $message;
        }elseif ($message['created_at']->format('m') == '09') {
          $settembre_m[$id][]= $message;
        }elseif ($message['created_at']->format('m') == '10') {
          $ottobre_m[$id][]= $message;
        }elseif ($message['created_at']->format('m') == '11') {
          $novembre_m[$id][]= $message;
        }elseif ($message['created_at']->format('m') == '12') {
          $dicembre_m[$id][]= $message;
        }
      }
    }

    // Contare per ogni mese quanti messaggi sono stati ricevuti per suite
    if(!empty($gennaio_m[$id])){$n_mess_gennaio=count($gennaio_m[$id]);}else{$n_mess_gennaio=0;}
    if(!empty($febbraio_m[$id])){$n_mess_febbraio=count($febbraio_m[$id]);}else{$n_mess_febbraio=0;}
    if(!empty($marzo_m[$id])){$n_mess_marzo=count($marzo_m[$id]);}else{$n_mess_marzo=0;}
    if(!empty($aprile_m[$id])){$n_mess_aprile=count($aprile_m[$id]);}else{$n_mess_aprile=0;}
    if(!empty($maggio_m[$id])){$n_mess_maggio=count($maggio_m[$id]);}else{$n_mess_maggio=0;}
    if(!empty($giugno_m[$id])){$n_mess_giugno=count($giugno_m[$id]);}else{$n_mess_giugno=0;}
    if(!empty($luglio_m[$id])){$n_mess_luglio=count($luglio_m[$id]);}else{$n_mess_luglio=0;}
    if(!empty($agosto_m[$id])){$n_mess_agosto=count($agosto_m[$id]);}else{$n_mess_agosto=0;}
    if(!empty($settembre_m[$id])){$n_mess_settembre=count($settembre_m[$id]);}else{$n_mess_settembre=0;}
    if(!empty($ottobre_m[$id])){$n_mess_ottobre=count($ottobre_m[$id]);}else{$n_mess_ottobre=0;}
    if(!empty($novembre_m[$id])){$n_mess_novembre=count($novembre_m[$id]);}else{$n_mess_novembre=0;}
    if(!empty($dicembre_m[$id])){$n_mess_dicembre=count($dicembre_m[$id]);}else{$n_mess_dicembre=0;}
    $n_mess_totali= $n_mess_gennaio+$n_mess_febbraio+$n_mess_marzo+$n_mess_aprile+$n_mess_maggio+$n_mess_giugno+$n_mess_luglio+$n_mess_agosto+$n_mess_settembre+$n_mess_ottobre+$n_mess_novembre+$n_mess_dicembre;


    // /////////////////////////////////// VISUALIZZAZIONI /////////////////////////////////////////

    // Inizializzazione array dei mesi per messaggi
    $gennaio_v=[];$febbraio_v=[];$marzo_v=[];$aprile_v=[];$maggio_v=[];$giugno_v=[];$luglio_v=[];$agosto_v=[];$settembre_v=[];$ottobre_v=[];$novembre_v=[];$dicembre_v=[];

    // Creazione variabile con tutti i messaggi
    $visits = Visit::all();

    // Filtrare per tutte le visite sul database
    foreach ($visits as $visit) {

      // Se l'id della suite combacia con l'id della suite della visita per ogni mese aggiungere la visita
      $data = Carbon::parse($visit['data']);

      if ($id == $visit->suite->id) {
        if ($data->month == '01') {
          $gennaio_v[$id][]= $visit;
        }elseif ($data->month == '02') {
          $febbraio_v[$id][]= $visit;
        }elseif ($data->month == '03') {
          $marzo_v[$id][]= $visit;
        }elseif ($data->month == '04') {
          $aprile_v[$id][]= $visit;
        }elseif ($data->month == '05') {
          $maggio_v[$id][]= $visit;
        }elseif ($data->month == '06') {
          $giugno_v[$id][]= $visit;
        }elseif ($data->month == '07') {
          $luglio_v[$id][]= $visit;
        }elseif ($data->month == '08') {
          $agosto_v[$id][]= $visit;
        }elseif ($data->month == '09') {
          $settembre_v[$id][]= $visit;
        }elseif ($data->month == '10') {
          $ottobre_v[$id][]= $visit;
        }elseif ($data->month == '11') {
          $novembre_v[$id][]= $visit;
        }elseif ($data->month == '12') {
          $dicembre_v[$id][]= $visit;
        }
      }
    }

    // Contare per ogni mese quanti messaggi sono stati ricevuti per suite
    if(!empty($gennaio_v[$id])){$n_vis_gennaio=count($gennaio_v[$id]);}else{$n_vis_gennaio=0;}
    if(!empty($febbraio_v[$id])){$n_vis_febbraio=count($febbraio_v[$id]);}else{$n_vis_febbraio=0;}
    if(!empty($marzo_v[$id])){$n_vis_marzo=count($marzo_v[$id]);}else{$n_vis_marzo=0;}
    if(!empty($aprile_v[$id])){$n_vis_aprile=count($aprile_v[$id]);}else{$n_vis_aprile=0;}
    if(!empty($maggio_v[$id])){$n_vis_maggio=count($maggio_v[$id]);}else{$n_vis_maggio=0;}
    if(!empty($giugno_v[$id])){$n_vis_giugno=count($giugno_v[$id]);}else{$n_vis_giugno=0;}
    if(!empty($luglio_v[$id])){$n_vis_luglio=count($luglio_v[$id]);}else{$n_vis_luglio=0;}
    if(!empty($agosto_v[$id])){$n_vis_agosto=count($agosto_v[$id]);}else{$n_vis_agosto=0;}
    if(!empty($settembre_v[$id])){$n_vis_settembre=count($settembre_v[$id]);}else{$n_vis_settembre=0;}
    if(!empty($ottobre_v[$id])){$n_vis_ottobre=count($ottobre_v[$id]);}else{$n_vis_ottobre=0;}
    if(!empty($novembre_v[$id])){$n_vis_novembre=count($novembre_v[$id]);}else{$n_vis_novembre=0;}
    if(!empty($dicembre_v[$id])){$n_vis_dicembre=count($dicembre_v[$id]);}else{$n_vis_dicembre=0;}
    $n_vis_totali= $n_vis_gennaio+$n_vis_febbraio+$n_vis_marzo+$n_vis_aprile+$n_vis_maggio+$n_vis_giugno+$n_vis_luglio+$n_vis_agosto+$n_vis_settembre+$n_vis_ottobre+$n_vis_novembre+$n_vis_dicembre;

    // Passare tutti i dati ricavati alla chiamata ajax
    return response()->json([
        'v_gennaio' => $n_vis_gennaio,
        'v_febbraio' => $n_vis_febbraio,
        'v_marzo' => $n_vis_marzo,
        'v_aprile' => $n_vis_aprile,
        'v_maggio' => $n_vis_maggio,
        'v_giugno' => $n_vis_giugno,
        'v_luglio' => $n_vis_luglio,
        'v_agosto' => $n_vis_agosto,
        'v_settembre' => $n_vis_settembre,
        'v_ottobre' => $n_vis_ottobre,
        'v_novembre' => $n_vis_novembre,
        'v_dicembre' => $n_vis_dicembre,
        'v_totale' => $n_vis_totali,
        'm_gennaio' => $n_mess_gennaio,
        'm_febbraio' => $n_mess_febbraio,
        'm_marzo' => $n_mess_marzo,
        'm_aprile' => $n_mess_aprile,
        'm_maggio' => $n_mess_maggio,
        'm_giugno' => $n_mess_giugno,
        'm_luglio' => $n_mess_luglio,
        'm_agosto' => $n_mess_agosto,
        'm_settembre' => $n_mess_settembre,
        'm_ottobre' => $n_mess_ottobre,
        'm_novembre' => $n_mess_novembre,
        'm_dicembre' => $n_mess_dicembre,
        'm_totale' => $n_mess_totali,
    ]);

  }
}

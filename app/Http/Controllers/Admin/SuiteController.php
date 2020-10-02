<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Suite;
use App\Message;
use App\Image;
use App\Visit;
use App\Highlight;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewMail;
use Carbon\Carbon;

class SuiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $suites = Suite::all();

        // Loop searching for admin suites
        foreach ($suites as $suite) {
          $id_my_suites = $user->id;
          if ($suite->user_id === $id_my_suites) {
            $my_suites[] = $suite;
          }
        }
        if (!isset($my_suites)) {
          $my_suites = '';
        }

        if(Auth::check()) {
          return view('admin.suites.index', compact('suites', 'user', 'my_suites'));
        } else {
          return view('guest.suites.index', compact('suites'));
        }
    }

    public function show(Suite $suite)
    {
      $user = Auth::user();
      return view('guest.suites.show', compact('suite', 'user'));
    }

    public function mysuites()
    {
        $user = Auth::user();
        $suites = Suite::all();

        // Loop searching for admin suites
        foreach ($suites as $suite) {
          $id_my_suites = $user->id;
          if ($suite->user_id === $id_my_suites) {
            $my_suites[] = $suite;
          }
        }
        if (!isset($my_suites)) {
          $my_suites = '';
        }

          return view('admin.suites.mysuites', compact('user', 'my_suites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.suites.create');
    }

    public function messages()
    {
        $messages = Message::all();
        $user = Auth::user();
        return view('admin.email.messages.index',compact('messages','user'));
    }

    


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'title'=> 'required|max:255',
        'address'=> 'required|max:255',
        'rooms'=> 'required|min:1',
        'beds'=> 'required|min:1',
        'baths'=> 'required|min:1',
        'square_m'=> 'required|min:1',
        // 'latitude'=> 'required|min:-90|max:90',
        // 'longitude'=> 'required|min:-180|max:180',
        'price'=> 'required|min:1|max:9999,99',
        'description'=> 'required',
        'main_image'=> 'required|image',
      ]);

      if (Auth::check()) {
        $request_data = $request->all();
        $path_image = $request->file('main_image')->store('images', 'public');
        // $user = Auth::user();  // da rivedere
        $new_suite = new Suite();
        $new_suite->user_id = Auth::id();
        $new_suite->title = $request_data['title'];
        $new_suite->address = $request_data['address'];
        $new_suite->rooms = $request_data['rooms'];
        $new_suite->beds = $request_data['beds'];
        $new_suite->baths = $request_data['baths'];
        $new_suite->square_m = $request_data['square_m'];
        $new_suite->latitude = 0; //$request_data['latitude'];
        $new_suite->longitude = 0; //$request_data['longitude'];
        $new_suite->price = $request_data['price'];
        $new_suite->description = $request_data['description'];
        $new_suite->main_image = $path_image;
        $new_suite->save();
        // aggiunta di più immagini alla suite
        // $new_image = new Image();
        // $new_image->suite_id = $request_data['suite_id'];
        // $new_image->suite_id = $request_data['suite_id'];
      }

      return redirect()->route('admin.suites.show', $new_suite);

    }

    public function store_payment(Request $request,Suite $suite)
    {
      $start = Carbon::now();
      if ($request->type == '24') {
        $suite->highlights()->attach(1,
          [
            'start' => $start,
            'end' => $end = Carbon::now()->addHours(24)
          ]);
      }elseif ($request->type == '72') {
        $suite->highlights()->attach(2,
          [
            'start' => $start,
            'end' => $end = Carbon::now()->addHours(72)
          ]);
      }else {
        $suite->highlights()->attach(3,
          [
            'start' => $start,
            'end' => $end = Carbon::now()->addHours(144)
          ]);
      }

      return redirect()->route('admin.suites.show', $suite);
    }

    public function payment(Suite $suite)
    {
      $user = Auth::user();
      return view('admin.suites.payment', compact('suite', 'user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Suite $suite)
    {
      return view('admin.suites.edit', compact('suite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suite $suite)
    {
      $request->validate([
        'title'=> 'required|max:255',
        'address'=> 'required|max:255',
        'rooms'=> 'required|min:1',
        'beds'=> 'required|min:1',
        'baths'=> 'required|min:1',
        'square_m'=> 'required|min:1',
        // 'latitude'=> 'required|min:-90|max:90',
        // 'longitude'=> 'required|min:-180|max:180',
        'price'=> 'required|min:1|max:9999,99',
        'description'=> 'required',
        'main_image'=> 'required|image',
      ]);
      $data = $request->all();
      $suite->user_id = Auth::id();
      $suite->title = $data['title'];
      $suite->beds = $data['beds'];
      $suite->baths = $data['baths'];
      $suite->rooms = $data['rooms'];
      $suite->square_m = $data['square_m'];
      $suite->address = $data['address'];
      $suite->price = $data['price'];
      $suite->description = $data['description'];
      $path_image = $request->file('main_image')->store('images', 'public');
      $suite->main_image = $path_image;
      $suite->update();

      return redirect()->route('admin.suites.show', $suite);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function static(Suite $suite)
    {
      // ////////////////////////////// MESSAGGI //////////////////////////////////////////////////

      // Inizializzazione array di mesi per messaggi
      $gennaio_m=[];$febbraio_m=[];$marzo_m=[];$aprile_m=[];$maggio_m=[];$giugno_m=[];$luglio_m=[];$agosto_m=[];$settembre_m=[];$ottobre_m=[];$novembre_m=[];$dicembre_m=[];

      // Creazione variabile con tutti i messaggi
      $messages = Message::all();
      // Ricavare id della suite
      $id = $suite->id;
      // Filtrare per tutti i messaggi
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


      // ////////////////////////////// VISUALIZZAZIONI ////////////////////////////////////////////

      // Inizializzazione array di mesi
      $gennaio_v=[];$febbraio_v=[];$marzo_v=[];$aprile_v=[];$maggio_v=[];$giugno_v=[];$luglio_v=[];$agosto_v=[];$settembre_v=[];$ottobre_v=[];$novembre_v=[];$dicembre_v=[];

      // Creazione variabile con tutti i messaggi
      $visits = Visit::all();
      // dd($visits);
      // Filtrare per tutti i messaggi
      foreach ($visits as $visit) {
        // Se l'id della suite combacia con l'id della suite del messaggio per ogni mese aggiungere il messaggio
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

      $user = Auth::user();
      return view('admin.suites.static', compact('suite', 'user','n_mess_totali','n_vis_totali'));
    }

}

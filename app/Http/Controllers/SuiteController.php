<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

// Import model
use App\Suite;
use App\Message;
use App\Highlight;
use App\Visit;
use Carbon\Carbon;
use App\Image;
use App\Service;

// Import Mail model
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewMail;

// Import Auth model
use Illuminate\Support\Facades\Auth;

// Database
use Illuminate\Support\Facades\DB;


class SuiteController extends Controller
{
  // ----------------------------------------- INDEX -----------------------------------------------
  public function index()
  {
    $services = Service::all();
    $suites = Suite::all();

    // Sql Query Join Highligts -> Suites
    $highlights_suites = DB::table('highlights')->join('highlight_suite', function($join)
    {
      $join->on('highlight_suite.highlight_id', '=', 'highlights.id');
    })->join('suites', function($join)
    {
      $join->on('highlight_suite.suite_id', '=', 'suites.id');
    })->orderBy('highlight_suite.start', 'DESC')->get();


    // If suite has highlight
    if (isset($highlights_suites)) {
      $highlights_suites_active = [];

      foreach ($highlights_suites as $highlight_suite) {
        $today = date('Y-m-d H:i:s');

        // If highlight is active (24H, 72H or 144H from start)
        if ( $today < $highlight_suite->end) {
          if(count($highlights_suites_active) < 6) {
          $highlights_suites_active[] = $highlight_suite;
          }
        }
      }
    }

    return view('guest.suites.index', compact('suites', 'highlights_suites_active', 'services'));
  }

  // ----------------------------------------- SHOW ------------------------------------------------
  public function show(Suite $suite)
  {
    $user_id = Auth::id();
    $user = Auth::user();

    $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

    if(!$pageWasRefreshed ) {
      if ($suite->user_id != $user_id) {
        $giorno = Carbon::now('Europe/Rome');
        $new_visit = new Visit();
        $new_visit->data = $giorno;
        $new_visit->ip = 90;
        $new_visit->suite_id = $suite['id'];
        $new_visit->save();
      }
    }

    return view('guest.suites.show', compact('suite', 'user'));
  }

  // ----------------------------------------- STORE -----------------------------------------------
  public function store(Request $request, Suite $suite)
  {
    $request->validate([
      'body' => 'required|max:2000',
      'email' => 'required|max:255',
      'name' => 'max:255',
    ]);

    $data_request = $request->all();
    $new_message = new Message();

    if (!empty($data_request['name'])) {
      $new_message->fill($data_request);
    } else {
      $new_message->body = $data_request['body'];
      $new_message->email = $data_request['email'];
    }

    $new_message->suite_id = $suite['id'];
    $new_message->save();
    Mail::to($new_message->suite->user->email)->send(new SendNewMail($new_message));

    return redirect()->route('suites.show', $suite);
  }

  // ------------------------------------- STORE MESSAGE -------------------------------------------
  public function store_message(Request $request, Suite $suite)
  {
    $request->validate([
      'body' => 'required|max:2000',
      'email' => 'required|max:255',
      'name' => 'required|max:255',
    ]);

    $data_request = $request->all();
    $new_message = new Message();

    if (!empty($data_request['name'])) {
      $new_message->fill($data_request);
    } else {
      $new_message->body = $data_request['body'];
      $new_message->email = $data_request['email'];
    }

    $new_message->suite_id = $suite['id'];
    $new_message->save();

    Mail::to($new_message->suite->user->email)
      ->send(new SendNewMail($new_message));

    return redirect()->route('suites.show', $suite);
  }

  // ----------------------------------------- SEARCH ----------------------------------------------
  public function search()
  {
    $services = Service::all();
    $suites = Suite::all();
    $images = Image::all();

    // Sql Query Join Highligts -> Suites
    $highlights_suites = DB::table('highlights')->join('highlight_suite', function($join)
    {
      $join->on('highlight_suite.highlight_id', '=', 'highlights.id');
    })->join('suites', function($join)
    {
      $join->on('highlight_suite.suite_id', '=', 'suites.id');
    })->orderBy('highlight_suite.start', 'DESC')->get();


    // If suite has highlight
    if (isset($highlights_suites)) {
      $highlights_suites_active = [];

      foreach ($highlights_suites as $highlight_suite) {
        $today = date('Y-m-d H:i:s');

        // If highlight is active (24H, 72H or 144H from start)
        if ( $today < $highlight_suite->end) {
          if(count($highlights_suites_active) < 6) {
          $highlights_suites_active[] = $highlight_suite;
          }
        }
      }
    }

    return view('guest.suites.search', compact('suites','services','images', 'highlights_suites_active'));
  }

  // --------------------------------------- HOME SEARCH -------------------------------------------
  public function homesearch(Request $request)
  {
    $services = Service::all();
    $search = $request->all();
    $key = $search['key'];
    $lat = $search['latitude'];
    $lng = $search['longitude'];

    return view('guest.suites.search', compact('key', 'lat', 'lng','services'));
  }

}

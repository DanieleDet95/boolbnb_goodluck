<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Suite;
use App\Message;
use App\Image;
use App\Visit;
use App\Service;
use App\Highlight;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewMail;
use App\Mail\SendNewEliminated;
use Carbon\Carbon;

class SuiteController extends Controller
{
  // ------------------------------------------ INDEX ----------------------------------------------
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

  // ------------------------------------------- SHOW ----------------------------------------------
  public function show(Suite $suite)
  {
    $user = Auth::user();
    return view('guest.suites.show', compact('suite', 'user'));
  }


  // ----------------------------------------- CREATE ----------------------------------------------
  public function create()
  {
    $services = Service::all();

    return view('admin.suites.create',compact('services'));
  }

  public function messages()
  {
      $messages = Message::all();
      $user = Auth::user();
      $now = Carbon::now();
      return view('admin.email.messages.index',compact('messages','user','now'));
  }

  // ---------------------------------------- STORE ------------------------------------------------
  public function store(Request $request)
  {
    $request->validate([
      'title'=> 'required|max:255',
      'address'=> 'required|max:255',
      'rooms'=> 'required|min:1',
      'beds'=> 'required|min:1',
      'baths'=> 'required|min:1',
      'square_m'=> 'required|min:1',
      'latitude'=> 'required|min:-90|max:90',
      'longitude'=> 'required|min:-180|max:180',
      'price'=> 'required|min:1|max:9999,99',
      'description'=> 'required',
      'main_image'=> 'required|image',
    ]);

    if (Auth::check()) {
      $request_data = $request->all();

      $path_image = $request->file('main_image')->store('images', 'public');
      $new_suite = new Suite();
      $new_suite->user_id = Auth::id();
      $new_suite->title = $request_data['title'];
      $new_suite->address = $request_data['address'];
      $new_suite->rooms = $request_data['rooms'];
      $new_suite->beds = $request_data['beds'];
      $new_suite->baths = $request_data['baths'];
      $new_suite->square_m = $request_data['square_m'];
      $new_suite->latitude = $request_data['latitude'];
      $new_suite->longitude = $request_data['longitude'];
      $new_suite->price = $request_data['price'];
      $new_suite->description = $request_data['description'];
      $new_suite->main_image = $path_image;
      $new_suite->save();

      if (isset($request_data['image1'])) {
          $new_image = new Image();
          $new_image->suite_id = $new_suite->id;
          $path_image = $request->file('image1')->store('images', 'public');
          $new_image->path = $path_image;
          $new_image->save();
      }
      if (isset($request_data['image2'])) {
          $new_image = new Image();
          $new_image->suite_id = $new_suite->id;
          $path_image = $request->file('image2')->store('images', 'public');
          $new_image->path = $path_image;
          $new_image->save();
      }
      if (isset($request_data['image3'])) {
          $new_image = new Image();
          $new_image->suite_id = $new_suite->id;
          $path_image = $request->file('image3')->store('images', 'public');
          $new_image->path = $path_image;
          $new_image->save();
      }

      if (isset($request_data['services'])) {

          $new_suite->services()->sync($request_data['services']);
      }

    }

    return redirect()->route('admin.suites.show', $new_suite);

  }

  // ------------------------------------------- EDIT ----------------------------------------------
  public function edit(Suite $suite)
  {
    $images = [];
    $all_images = Image::all();
    foreach ($all_images as $image) {
      if ($image->suite_id == $suite->id) {
        $images[] = $image;
      }
    }

    $services = Service::all();
    return view('admin.suites.edit', compact('suite','services','images'));
  }

  // ---------------------------------------- UPDATE -----------------------------------------------
  public function update(Request $request, Suite $suite)
  {
    $request->validate([
      'title'=> 'required|max:255',
      'address'=> 'required|max:255',
      'rooms'=> 'required|min:1',
      'beds'=> 'required|min:1',
      'baths'=> 'required|min:1',
      'square_m'=> 'required|min:1',
      'latitude'=> 'required|min:-90|max:90',
      'longitude'=> 'required|min:-180|max:180',
      'price'=> 'required|min:1|max:9999,99',
      'description'=> 'required',
    ]);
    $data = $request->all();
    $suite->user_id = Auth::id();
    $suite->title = $data['title'];
    $suite->beds = $data['beds'];
    $suite->baths = $data['baths'];
    $suite->rooms = $data['rooms'];
    $suite->square_m = $data['square_m'];
    $suite->address = $data['address'];
    $suite->latitude = $data['latitude'];
    $suite->longitude = $data['longitude'];
    $suite->price = $data['price'];
    $suite->description = $data['description'];

    // dd($request->file('main_image'));
    if (!is_null($request->file('main_image'))) {
      $path_image = $request->file('main_image')->store('images', 'public');
    }else {
      $path_image = $suite->main_image;
    }

    $suite->main_image = $path_image;
    $suite->update();

    if (isset($data['image1'])) {

        $suite->images[0]->suite_id = $suite->id;

        if (!is_null($request->file('image1'))) {
          $path_image = $request->file('image1')->store('images', 'public');
        }else {
          $path_image = $suite->images[0]->path;
        }
        // dd($path_image);
        $suite->images[0]->path = $path_image;
        $suite->images[0]->update();
    }

    if (isset($data['image2'])) {

        $suite->images[1]->suite_id = $suite->id;

        if (!is_null($request->file('image2'))) {
          $path_image = $request->file('image2')->store('images', 'public');
        }else {
          $path_image = $suite->images[1]->path;
        }

        $suite->images[1]->path = $path_image;
        $suite->images[1]->update();
    }


    if (isset($data['services'])) {
          $suite->services()->sync($data['services']);
      } else {
          $suite->services()->detach();
      }

    return redirect()->route('admin.suites.show', $suite);
  }

  // ---------------------------------------- MY SUITES --------------------------------------------
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

  // ----------------------------------------- STATIC ----------------------------------------------
  public function static(Suite $suite)
  {
    $user = Auth::user();
    return view('admin.suites.static', compact('suite', 'user'));
  }

  // --------------------------------------- DESTROY --------------------------------------------
  public function destroy(Suite $suite)
  {
      Mail::to($suite->user->email)->send(new SendNewEliminated($suite));

      $suite->delete();

      return redirect()->route('admin.suites.mysuites');

  }
}

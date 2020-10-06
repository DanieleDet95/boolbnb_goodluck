<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Suite;
use Carbon\Carbon;
// use Illuminate\Http\Response;
// use DB;

class SearchController extends Controller
{
    public function index(Request $request) {

      $now = Carbon::now();

      $R = 6371; // raggio della Terra in km

      $rad = $request->get('range');
      $rooms = $request->get('rooms');
      $beds = $request->get('beds');
      $baths = $request->get('baths');
      $square_m = $request->get('square_m');
      $price = floatval($request->get('price'));
      $pool = $request->get('pool');
      $wifi = $request->get('wifi');
      $pet = $request->get('pet');
      $parking = $request->get('parking');
      $piano = $request->get('piano');
      $sauna = $request->get('sauna');
      $lat = floatval($request->get('latitude'));
      $lng = floatval($request->get('longitude'));

      $params = [
            "maxLat" => $lat + rad2deg($rad/$R),
            "minLat" => $lat - rad2deg($rad/$R),
            "maxLng" => $lng + rad2deg(asin($rad/$R) / cos(deg2rad($lat))),
            "minLng" => $lng - rad2deg(asin($rad/$R) / cos(deg2rad($lat))),
        ];

      $suites = Suite::all();

      foreach ($suites as $suite){
        foreach ($suite->highlights as $promo) {
          $end = $promo->pivot->end;
          if($end < $now){
            $suite->highlights()->detach($promo);
          }
        }
      }


      $queryPromo = Suite::query();

      $queryPromo->has('highlights')->with('highlights');

      $queryPromo->selectRaw(
        "*,
        ( 6371 * acos( cos( radians(?))
        * cos( radians( latitude ))
        * cos( radians( longitude )
        - radians(?))
        + sin( radians(?))
        * sin( radians( latitude )))) AS distance", [$lat, $lng, $lat]);
      $queryPromo->orderBy('distance', 'asc');

      if ($pool == 'true') {
        $queryPromo->whereHas('services', function (Builder $query) {
          $query->where('service_id', '=', '1');
         });
      }

      if ($wifi == 'true') {
        $queryPromo->whereHas('services', function (Builder $query) {
          $query->where('service_id', '=', '2');
          });
      }

      if ($pet == 'true') {
        $queryPromo->whereHas('services', function (Builder $query) {
          $query->where('service_id', '=', '3');
         });
      }

      if ($parking == 'true') {
        $queryPromo->whereHas('services', function (Builder $query) {
          $query->where('service_id', '=', '4');
        });
      }

      if ($piano == 'true') {
        $queryPromo->whereHas('services', function (Builder $query) {
          $query->where('service_id', '=', '5');
         });
      }

      if ($sauna == 'true') {
        $queryPromo->whereHas('services', function (Builder $query) {
          $query->where('service_id', '=', '6');
          });
      }

      if ($rooms) {
        $queryPromo->where('rooms', ">=", $rooms);
      }

      if ($beds) {
        $queryPromo->where('beds', ">=", $beds);
      }

      if ($baths) {
        $queryPromo->where('baths', ">=", $baths);
      }

      if ($square_m) {
        $queryPromo->where('square_m', ">=", $parking);
      }

      if ($price != 0) {
        $queryPromo->where('price', "<=", $price);
      }

      $promo = $queryPromo->get();

      $querySuite = Suite::query();

      $querySuite->selectRaw(
        "*,
        ( 6371 * acos( cos( radians(?))
        * cos( radians( latitude ))
        * cos( radians( longitude )
        - radians(?))
        + sin( radians(?))
        * sin( radians( latitude )))) AS distance", [$lat, $lng, $lat]);
      $querySuite->orderBy('distance', 'asc');


        if ($pool == 'true') {
          $querySuite->whereHas('services', function (Builder $query) {
            $query->where('service_id', '=', '1');
           });
        }

        if ($wifi == 'true') {
          $querySuite->whereHas('services', function (Builder $query) {
            $query->where('service_id', '=', '2');
            });
        }

        if ($pet == 'true') {
          $querySuite->whereHas('services', function (Builder $query) {
            $query->where('service_id', '=', '3');
           });
        }

        if ($parking == 'true') {
          $querySuite->whereHas('services', function (Builder $query) {
            $query->where('service_id', '=', '4');
          });
        }

        if ($piano == 'true') {
          $querySuite->whereHas('services', function (Builder $query) {
            $query->where('service_id', '=', '5');
           });
        }

        if ($sauna == 'true') {
          $querySuite->whereHas('services', function (Builder $query) {
            $query->where('service_id', '=', '6');
            });
        }

        if ($rooms) {
          $querySuite->where('rooms', ">=", $rooms);
        }

        if ($beds) {
          $querySuite->where('beds', ">=", $beds);
        }

        if ($baths) {
          $querySuite->where('baths', ">=", $baths);
        }

        if ($square_m) {
          $querySuite->where('square_m', ">=", $parking);
        }

        if ($price != 0) {
          $querySuite->where('price', "<=", $price);
        }

      $noPromo = $querySuite->doesnthave('highlights')->get();

      return response()->json([
        'noPromo' => $noPromo,
        'promo' => $promo
      ]);

    }
}

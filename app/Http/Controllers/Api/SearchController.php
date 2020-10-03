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


      $querySuite = Suite::query();
      // $querySuite->whereHas('highlight_suite', function(Builder $query) {
      //   $querySuite->where('end', '>', )
      // })

      $querySuite->whereBetween('latitude', [$params['minLat'], $params['maxLat']]);
      $querySuite->whereBetween('longitude', [$params['minLng'], $params['maxLng']]);

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

        return $querySuite->get();

      // return response()->json([
      //   'nopromo' => $querySuite,
      //   'promo' => 'ciao'
      // ]);

    }
}

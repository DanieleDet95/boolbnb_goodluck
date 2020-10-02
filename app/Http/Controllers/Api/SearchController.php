<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Suite;
use DB;

class SearchController extends Controller
{
    public function index(Request $request) {
      $R = 6371; // raggio della Terra in km
      $rad = 2000;

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


      $querySuite->whereBetween('latitude', [$params['minLat'], $params['maxLat']]);
      $querySuite->whereBetween('longitude', [$params['minLng'], $params['maxLng']]);

      return $querySuite->get();

      // $querySuite = DB::table('suites')->join('service_suite', function($join)
      // {
      //   $join->on('service_suite.service_id', '=', 'suites.id');
      // })->get();

    }
}

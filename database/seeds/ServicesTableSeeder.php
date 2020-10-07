<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $services = [
        'pool',
        'wifi',
        'pet',
        'parking',
        'pianoforte',
        'sauna',
      ];

      $icons = [
        'fas fa-swimmer',
        'fas fa-wifi',
        'fas fa-paw',
        'fas fa-parking',
        'fas fa-music',
        'fas fa-hot-tub',
      ];

      // foreach ($services as $service) {
      //   $new_service = new Service();
      //   $new_service->supplements = $service;
      //   $new_service->icon = $icons;
      //   $new_service->save();
      // }
      for ($i=0; $i < 6; $i++) {
        $new_service = new Service();
        $new_service->supplements = $services[$i];
        $new_service->icon = $icons[$i];
        $new_service->save();
      }
    }
}

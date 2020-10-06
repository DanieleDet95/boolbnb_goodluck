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

      foreach ($services as $service) {
        $new_service = new Service();
        $new_service->supplements = $service;
        $new_service->save();
      }
    }
}

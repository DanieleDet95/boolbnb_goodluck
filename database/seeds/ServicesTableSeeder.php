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
      $supplements = [
        'pool',
        'wifi',
        'pet',
        'parking',
        'pianoforte',
        'sauna',
      ];

      foreach ($supplements as $supplement) {
        $new_service = new Service();
        $new_service->supplements = $supplement;
        $new_service->save();
      }
    }
}

<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Visit;

class VisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run(Faker $faker)
     {

       for ($i=0; $i < 20; $i++) {
         $new_visit = new Visit();
         $new_visit->suite_id = rand(1,23);
         $new_visit->ip = rand(11,99);
         $new_visit->data = $faker->dateTime();
         $new_visit->save();
       }
     }
}

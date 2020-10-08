<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Image;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 500; $i++) {
          for ($i_image=0; $i_image < 2; $i_image++) {
            $new_image = new Image();
            $new_image->path = $faker->imageUrl($width = 150, $height = 100);
            $new_image->suite_id = $i + 1;
            $new_image->save();
          }
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Highlight;

class HighlightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $type = [
          24,
          72,
          144,
        ];
        $price = [
          2.99,
          5.99,
          9.99,
        ];

        for ($i=0; $i < 3; $i++) {
          $new_highlight = new Highlight();
          $new_highlight->id = $i + 1;
          $new_highlight->type = $type[$i];
          $new_highlight->price = $price[$i];
          $new_highlight->save();
        }
    }
}

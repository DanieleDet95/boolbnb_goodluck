<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Message;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run(Faker $faker)
     {

       for ($i=0; $i < 10; $i++) {
         $new_message = new Message();
         $new_message->suite_id = rand(1,23);
         $new_message->email = $faker->email;
         $new_message->body = $faker->text(1000);
         $new_message->name = $faker->name;
         $new_message->save();
       }
     }
}

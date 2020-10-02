<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

      for ($i=0; $i < 12; $i++) {
        // dd($faker->date('d.m.Y'));
        $new_user = new User();
        $new_user->name = $faker->name;
        $new_user->lastname = $faker->lastname;
        $new_user->birthday = $faker->date('Y-m-d'); // $faker->date('d-m-Y') da chiedere a Chiara
        $new_user->email = $faker->email;
        $new_user->phone = $faker->e164PhoneNumber;
        $new_user->password = Hash::make($faker->password);

        $new_user->save();
      }
    }
}

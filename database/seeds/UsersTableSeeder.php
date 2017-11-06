<?php

use App\User;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;


class UsersTableSeeder extends Seeder {

public function run()
{

    /*$faker = Faker::create();

    foreach(range(1,25) as $index)
    {
        User::create([
            'name' => $faker->word . $index,
            'email' => $faker->email,
            'password' => 'secret'
        ]);
    }*/
    factory('App\User', 50)->create();

/*DB::table('users')->delete();

User::create(['name' => 'John Dow','email' => 'foo@bar.com', 'password' => bcrypt('password')]);*/
}

}
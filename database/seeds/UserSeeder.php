<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Profile;

class UserSeeder extends Seeder
{
    public function run()
    {
    	$faker = Faker\Factory::create('es_ES');

	    DB::table('users')->insert([
	        'name' => 'pAdRoNe',
	        'email' => 'dgranh@gmail.com',
	        'password' => Hash::make('corleone'),
	        'is_admin' => 1,
	        'email_verified_at' => now(),
	        'created_at' => now(),
	        'updated_at' => now(),
	    ]);

	    DB::table('users')->insert([
	        'name' => 'Marcel',
	        'email' => 'marcel@gmail.com',
	        'password' => Hash::make('1234'),
	        'is_admin' => 1,
	        'email_verified_at' => now(),
	        'created_at' => now(),
	        'updated_at' => now(),
	    ]);

	    DB::table('users')->insert([
	        'name' => 'Gabri',
	        'email' => 'gabri@gmail.com',
	        'password' => Hash::make('1234'),
	        'is_admin' => 1,
	        'email_verified_at' => now(),
	        'created_at' => now(),
	        'updated_at' => now(),
	    ]);

		for ($i=0; $i < 100; $i++) {
			$name = 'user_test_' . $i;
		    DB::table('users')->insert([
		        'name' => $name,
		        'email' => $name.'@gmail.com',
		        'password' => Hash::make('secret'),
		        'is_admin' => 0,
		        'email_verified_at' => now(),
		        'created_at' => now(),
		        'updated_at' => now(),
		    ]);
		}

		foreach (User::all() as $user) {
		    $user->profile()->create([
		        'user_id' => $user->id,
		        'location' => $faker->city,
		        'birthdate' => $faker->dateTimeBetween('1970-01-01', '1999-12-31')
		    ]);
			$user->positions()->create([
		        'user_id' => $user->id,
		        'game_id' => 1,
		        'position_id' => mt_rand(1, 14)
		    ]);
			$user->positions()->create([
		        'user_id' => $user->id,
		        'game_id' => 4,
		        'position_id' => mt_rand(46, 58)
		    ]);
		}
    }
}
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class eTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('es_ES');

		for ($i=0; $i < 30; $i++) {
			$name = $faker->company;
			$short_name = Str::upper(Str::substr($name, 0, 3));
		    DB::table('eteams')->insert([
		    	'game_id' => 1,
		    	'owner_id' => mt_rand(1, 101),
		        'name' => $name,
		        'location' => $faker->city,
		        'short_name' => $short_name,
		        'slug' => Str::slug($name, '-'),
		        'created_at' => now(),
		        'updated_at' => now(),
		    ]);
		}
    }
}

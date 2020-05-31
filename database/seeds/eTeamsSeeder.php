<?php

use Illuminate\Database\Seeder;

class eTeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('es_ES');

		for ($i=0; $i < 10; $i++) {
			$name = $faker->company;
			$short_name = Str::upper(Str::substr($name, 0, 3));
		    DB::table('eteams')->insert([
		    	'game_id' => 1,
		        'name' => $name,
		        'short_name' => $short_name,
		        'created_at' => now(),
		        'updated_at' => now(),
		    ]);
		}
    }
}

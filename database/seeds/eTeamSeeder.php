<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\ETeam;

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

		for ($i=0; $i < 100; $i++) {
			$name = $faker->company;
			$short_name = Str::upper(Str::substr($name, 0, 3));
		    DB::table('eteams')->insert([
		    	'game_id' => rand(1, 7),
		    	'owner_id' => mt_rand(1, 101),
		        'name' => $name,
		        'location' => $faker->city,
		        'short_name' => $short_name,
		        'slug' => Str::slug($name, '-'),
		        'created_at' => now(),
		        'updated_at' => now(),
		    ]);
		}

		foreach (ETeam::all() as $eteam) {
		    $eteam->users()->create([
		        'eteam_id' => $eteam->id,
		        'user_id'  => $eteam->owner_id,
		        'admin'    => 1
		    ]);
			for ($i=0; $i < 5; $i++) {
			    $eteam->users()->create([
			        'eteam_id' => $eteam->id,
			        'user_id'  => mt_rand(1, 103)
			    ]);
			}
		}
    }
}

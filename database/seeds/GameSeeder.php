<?php

use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('games')->insert([
			'platform_id' => 1,
			'name' => 'Fifa 20',
			'mode_league' => true,
			'mode_playoffs' => true,
			'rosters' => true,
	    ]);
	    DB::table('games')->insert([
			'platform_id' => 1,
			'name' => 'GT Rancing',
			'mode_races' => true,
	    ]);
    }
}

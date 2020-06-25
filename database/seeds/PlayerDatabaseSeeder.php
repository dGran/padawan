<?php

use Illuminate\Database\Seeder;

class PlayerDatabaseSeeder extends Seeder
{
    public function run()
    {
	    DB::table('players_databases')->insert([
	        'name' => 'DLC 8',
	        'game_id' => 4,
	        'slug' => 'dlc-8-efootball-pes-2020-playstation-4',
	    ]);
	    DB::table('players_databases')->insert([
	        'name' => 'DLC 8',
	        'game_id' => 5,
	        'slug' => 'dlc-8-efootball-pes-2020-xbox-one-x',
	    ]);
	    DB::table('players_databases')->insert([
	        'name' => 'Octubre',
	        'game_id' => 1,
	        'slug' => 'octubre-fifa-20-playstation-4',
	    ]);
    }
}
<?php

use Illuminate\Database\Seeder;

class GamePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'PO',
			'category' => 'Porteros',
			'order' => 11,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'DFC',
			'category' => 'Defensas',
			'order' => 22,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'LD',
			'category' => 'Defensas',
			'order' => 23,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'LI',
			'category' => 'Defensas',
			'order' => 24,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'CAD',
			'category' => 'Defensas',
			'order' => 25,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'CAI',
			'category' => 'Defensas',
			'order' => 26,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'MCD',
			'category' => 'Medios',
			'order' => 31,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'MC',
			'category' => 'Medios',
			'order' => 32,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'MD',
			'category' => 'Medios',
			'order' => 33,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'MI',
			'category' => 'Medios',
			'order' => 34,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'MCO',
			'category' => 'Medios',
			'order' => 35,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'ED',
			'category' => 'Delanteros',
			'order' => 41,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'EI',
			'category' => 'Delanteros',
			'order' => 42,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'SD',
			'category' => 'Delanteros',
			'order' => 43,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'DC',
			'category' => 'Delanteros',
			'order' => 44,
	    ]);
    }
}

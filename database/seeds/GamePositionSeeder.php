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
    	//FIFA POSITIONS
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'PO',
			'category' => 'Porteros',
			'font_icon' => 'icon-pos-por',
			'order' => 11,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'DFC',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 22,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'LD',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 23,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'LI',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 24,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'CAD',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 25,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'CAI',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 26,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'MCD',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 31,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'MC',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 32,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'MD',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 33,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'MI',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 34,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'MCO',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 35,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'ED',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 41,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'EI',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 42,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'SD',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 43,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 1,
			'name' => 'DC',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 44,
	    ]);

	    DB::table('games_positions')->insert([
			'game_id' => 2,
			'name' => 'PO',
			'category' => 'Porteros',
			'font_icon' => 'icon-pos-por',
			'order' => 11,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 2,
			'name' => 'DFC',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 22,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 2,
			'name' => 'LD',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 23,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 2,
			'name' => 'LI',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 24,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 2,
			'name' => 'CAD',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 25,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 2,
			'name' => 'CAI',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 26,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 2,
			'name' => 'MCD',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 31,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 2,
			'name' => 'MC',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 32,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 2,
			'name' => 'MD',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 33,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 2,
			'name' => 'MI',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 34,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 2,
			'name' => 'MCO',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 35,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 2,
			'name' => 'ED',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 41,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 2,
			'name' => 'EI',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 42,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 2,
			'name' => 'SD',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 43,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 2,
			'name' => 'DC',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 44,
	    ]);

	    DB::table('games_positions')->insert([
			'game_id' => 3,
			'name' => 'PO',
			'category' => 'Porteros',
			'font_icon' => 'icon-pos-por',
			'order' => 11,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 3,
			'name' => 'DFC',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 22,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 3,
			'name' => 'LD',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 23,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 3,
			'name' => 'LI',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 24,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 3,
			'name' => 'CAD',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 25,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 3,
			'name' => 'CAI',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 26,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 3,
			'name' => 'MCD',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 31,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 3,
			'name' => 'MC',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 32,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 3,
			'name' => 'MD',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 33,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 3,
			'name' => 'MI',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 34,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 3,
			'name' => 'MCO',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 35,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 3,
			'name' => 'ED',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 41,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 3,
			'name' => 'EI',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 42,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 3,
			'name' => 'SD',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 43,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 3,
			'name' => 'DC',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 44,
	    ]);

    	//PES POSITIONS
	    DB::table('games_positions')->insert([
			'game_id' => 4,
			'name' => 'PT',
			'category' => 'Porteros',
			'font_icon' => 'icon-pos-por',
			'order' => 11,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 4,
			'name' => 'CT',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 22,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 4,
			'name' => 'LD',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 23,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 4,
			'name' => 'LI',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 24,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 4,
			'name' => 'MCD',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 31,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 4,
			'name' => 'MC',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 32,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 4,
			'name' => 'ID',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 33,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 4,
			'name' => 'II',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 34,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 4,
			'name' => 'MP',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 35,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 4,
			'name' => 'ED',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 41,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 4,
			'name' => 'EI',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 42,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 4,
			'name' => 'SD',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 43,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 4,
			'name' => 'DC',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 44,
	    ]);

	    DB::table('games_positions')->insert([
			'game_id' => 5,
			'name' => 'PT',
			'category' => 'Porteros',
			'font_icon' => 'icon-pos-por',
			'order' => 11,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 5,
			'name' => 'CT',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 22,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 5,
			'name' => 'LD',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 23,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 5,
			'name' => 'LI',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 24,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 5,
			'name' => 'MCD',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 31,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 5,
			'name' => 'MC',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 32,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 5,
			'name' => 'ID',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 33,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 5,
			'name' => 'II',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 34,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 5,
			'name' => 'MP',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 35,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 5,
			'name' => 'ED',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 41,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 5,
			'name' => 'EI',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 42,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 5,
			'name' => 'SD',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 43,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 5,
			'name' => 'DC',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 44,
	    ]);

	    DB::table('games_positions')->insert([
			'game_id' => 6,
			'name' => 'PT',
			'category' => 'Porteros',
			'font_icon' => 'icon-pos-por',
			'order' => 11,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 6,
			'name' => 'CT',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 22,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 6,
			'name' => 'LD',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 23,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 6,
			'name' => 'LI',
			'category' => 'Defensas',
			'font_icon' => 'icon-pos-def',
			'order' => 24,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 6,
			'name' => 'MCD',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 31,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 6,
			'name' => 'MC',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 32,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 6,
			'name' => 'ID',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 33,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 6,
			'name' => 'II',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 34,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 6,
			'name' => 'MP',
			'category' => 'Medios',
			'font_icon' => 'icon-pos-med',
			'order' => 35,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 6,
			'name' => 'ED',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 41,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 6,
			'name' => 'EI',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 42,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 6,
			'name' => 'SD',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 43,
	    ]);
	    DB::table('games_positions')->insert([
			'game_id' => 6,
			'name' => 'DC',
			'category' => 'Delanteros',
			'font_icon' => 'icon-pos-del',
			'order' => 44,
	    ]);
    }
}

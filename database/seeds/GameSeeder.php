<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
			'positions' => true,
			'slug' => Str::slug('Fifa 20 PlayStation 4', '-'),
	    ]);
	    DB::table('games')->insert([
			'platform_id' => 2,
			'name' => 'Fifa 20',
			'mode_league' => true,
			'mode_playoffs' => true,
			'rosters' => true,
			'positions' => true,
			'slug' => Str::slug('Fifa 20 Xbox One X', '-'),
	    ]);
	    DB::table('games')->insert([
			'platform_id' => 4,
			'name' => 'Fifa 20',
			'mode_league' => true,
			'mode_playoffs' => true,
			'rosters' => true,
			'positions' => true,
			'slug' => Str::slug('Fifa 20 Origin', '-'),
	    ]);
	    DB::table('games')->insert([
			'platform_id' => 1,
			'name' => 'eFootball PES 2020',
			'mode_league' => true,
			'mode_playoffs' => true,
			'rosters' => true,
			'positions' => true,
			'slug' => Str::slug('eFootball PES 2020 PlayStation 4', '-'),
	    ]);
	    DB::table('games')->insert([
			'platform_id' => 2,
			'name' => 'eFootball PES 2020',
			'mode_league' => true,
			'mode_playoffs' => true,
			'rosters' => true,
			'positions' => true,
			'slug' => Str::slug('eFootball PES 2020 Xbox One X', '-'),
	    ]);
	    DB::table('games')->insert([
			'platform_id' => 3,
			'name' => 'eFootball PES 2020',
			'mode_league' => true,
			'mode_playoffs' => true,
			'rosters' => true,
			'positions' => true,
			'slug' => Str::slug('eFootball PES 2020 Steam', '-'),
	    ]);
	    DB::table('games')->insert([
			'platform_id' => 1,
			'name' => 'Gran Turismo Sport',
			'mode_races' => true,
			'circuits' => true,
			'slug' => Str::slug('Gran Turismo Sport PlayStation 4', '-'),
	    ]);
    }
}

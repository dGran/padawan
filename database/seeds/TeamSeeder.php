<?php

use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('teams')->insert([
	    	'game_id' => 1,
	        'name' => 'FC Barcelona',
	        'league_name' => 'Liga Santander',
	        'slug' => 'fc-barcelona-fifa-20-playStation-4',
	    ]);

	    DB::table('teams')->insert([
	    	'game_id' => 1,
	        'name' => 'Real Madrid',
	        'league_name' => 'Liga Santander',
	        'slug' => 'real-madrid-fifa-20-playStation-4',
	    ]);

	    DB::table('teams')->insert([
	    	'game_id' => 1,
	        'name' => 'AC Milan',
	        'league_name' => 'Serie A',
	        'slug' => 'ac-milan-fifa-20-playStation-4',
	    ]);

	    DB::table('teams')->insert([
	    	'game_id' => 1,
	        'name' => 'Juventus',
	        'league_name' => 'Serie A',
	        'slug' => 'juventus-fifa-20-playStation-4',
	    ]);

	    DB::table('teams')->insert([
	    	'game_id' => 1,
	        'name' => 'Liverpool',
	        'league_name' => 'Premier League',
	        'slug' => 'liverpool-fifa-20-playStation-4',
	    ]);

	    DB::table('teams')->insert([
	    	'game_id' => 1,
	        'name' => 'Manchester United',
	        'league_name' => 'Premier League',
	        'slug' => 'manchester-united-fifa-20-playStation-4',
	    ]);

	    DB::table('teams')->insert([
	    	'game_id' => 4,
	        'name' => 'FC Barcelona',
	        'league_name' => 'Liga Santander',
	        'slug' => 'fc-barcelona-efootball-pes-2020-playStation-4',
	    ]);

	    DB::table('teams')->insert([
	    	'game_id' => 4,
	        'name' => 'Real Madrid',
	        'league_name' => 'Liga Santander',
	        'slug' => 'real-madrid-efootball-pes-2020-playStation-4',
	    ]);

	    DB::table('teams')->insert([
	    	'game_id' => 4,
	        'name' => 'AC Milan',
	        'league_name' => 'Serie A',
	        'slug' => 'ac-milan-efootball-pes-2020-playStation-4',
	    ]);

	    DB::table('teams')->insert([
	    	'game_id' => 4,
	        'name' => 'Juventus',
	        'league_name' => 'Serie A',
	        'slug' => 'juventus-efootball-pes-2020-playStation-4',
	    ]);

	    DB::table('teams')->insert([
	    	'game_id' => 4,
	        'name' => 'Liverpool',
	        'league_name' => 'Premier League',
	        'slug' => 'liverpool-efootball-pes-2020-playStation-4',
	    ]);

	    DB::table('teams')->insert([
	    	'game_id' => 4,
	        'name' => 'Manchester United',
	        'league_name' => 'Premier League',
	        'slug' => 'manchester-united-efootball-pes-2020-playStation-4',
	    ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    public function run()
    {
	    DB::table('platforms')->insert([
	        'name' => 'PlayStation 4',
	    ]);
	    DB::table('platforms')->insert([
	        'name' => 'Xbox One X',
	    ]);
	    DB::table('platforms')->insert([
	        'name' => 'PC - Steam',
	    ]);
	    DB::table('platforms')->insert([
	        'name' => 'PC - Origin',
	    ]);
    }
}

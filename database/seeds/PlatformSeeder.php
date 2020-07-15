<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PlatformSeeder extends Seeder
{
    public function run()
    {
	    DB::table('platforms')->insert([
	        'name' => 'PlayStation 4',
	        'color' => 'red',
	        'slug' => Str::slug('PlayStation 4', '-'),
	    ]);
	    DB::table('platforms')->insert([
	        'name' => 'Xbox One X',
	        'color' => 'green',
	        'slug' => Str::slug('Xbox One X', '-'),
	    ]);
	    DB::table('platforms')->insert([
	        'name' => 'Steam',
	        'color' => 'blue',
	        'slug' => Str::slug('Steam', '-'),
	    ]);
	    DB::table('platforms')->insert([
	        'name' => 'Origin',
	        'color' => 'blue',
	        'slug' => Str::slug('Origin', '-'),
	    ]);
	    DB::table('platforms')->insert([
	        'name' => 'PlayStation 5',
	        'color' => 'red',
	        'slug' => Str::slug('PlayStation 5', '-'),
	    ]);
	    DB::table('platforms')->insert([
	        'name' => 'Xbox Series X',
	        'color' => 'green',
	        'slug' => Str::slug('Xbox Series X', '-'),
	    ]);
    }
}

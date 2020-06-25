<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PlatformSeeder extends Seeder
{
    public function run()
    {
	    DB::table('platforms')->insert([
	        'name' => 'PlayStation 4',
	        'slug' => Str::slug('PlayStation 4', '-'),
	    ]);
	    DB::table('platforms')->insert([
	        'name' => 'Xbox One X',
	        'slug' => Str::slug('Xbox One X', '-'),
	    ]);
	    DB::table('platforms')->insert([
	        'name' => 'Steam',
	        'slug' => Str::slug('Steam', '-'),
	    ]);
	    DB::table('platforms')->insert([
	        'name' => 'Origin',
	        'slug' => Str::slug('Origin', '-'),
	    ]);
	    DB::table('platforms')->insert([
	        'name' => 'PlayStation 5',
	        'slug' => Str::slug('PlayStation 5', '-'),
	    ]);
	    DB::table('platforms')->insert([
	        'name' => 'Xbox Series X',
	        'slug' => Str::slug('Xbox Series X', '-'),
	    ]);
    }
}

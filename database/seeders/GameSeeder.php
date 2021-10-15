<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $game = Game::create([
            'name' => 'GT Sport',
            'logo' => 'games/logos/gt-sport.png',
            'banner' => 'games/banners/gt-sport.jpeg',
            'racing' => 1,
            'allow_eteams' => 1,
            'slug' => 'gt-sport'
        ]);

        $game = Game::create([
            'name' => 'Fifa 22',
            'logo' => 'games/logos/fifa-22.png',
            'banner' => 'games/banners/fifa-22.jpeg',
            'allow_eteams' => 1,
            'slug' => 'fifa-22'
        ]);
    }
}
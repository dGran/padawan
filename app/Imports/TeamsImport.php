<?php

namespace App\Imports;

use App\Team;
use App\Game;
use Illuminate\Support\Str;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
// use Maatwebsite\Excel\Concerns\WithValidation;


class TeamsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $game = Game::find($row['game_id']);
        if ($game) {
            $gameName = $game->name;
            $platformName = $game->platform->name;
            $row['slug'] = Str::slug($row['name'] . ' ' . $gameName . ' ' . $platformName, '-');

            //check team
            if (!Team::where('slug', '=', $row['slug'])->exists()) {
                $team = Team::create([
                    'name'         => $row['name'],
                    'game_id'      => $row['game_id'],
                    'img'          => $row['img'],
                    'league_name'  => $row['league_name'],
                    'slug'         => $row['slug'],
                ]);
                return $team;
            }
        }
    }
}
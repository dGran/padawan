<?php

namespace App\Imports;

use App\Team;
use App\Game;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class TeamsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $game = Game::find($row['game_id']);
        if ($game) {
            $gameName = $game->name;
            $platformName = $game->platform->name;
            $slug = Str::slug($row['name'] . ' ' . $gameName . ' ' . $platformName, '-');

            if (!Team::where('slug', '=', $slug)->exists()) {
                $team = Team::create([
                    'name'         => $row['name'],
                    'game_id'      => $row['game_id'],
                    'league_name'  => $row['league_name'],
                    'slug'         => $slug,
                ]);
                return $team;
            }
        }
    }
}
<?php

namespace App\Imports;

use App\PlayerDatabase;
use App\Game;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class PlayersDatabasesImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $game = Game::find($row['game_id']);
        if ($game) {
            $gameName = $game->name;
            $platformName = $game->platform->name;
            $slug = Str::slug($row['name'] . ' ' . $gameName . ' ' . $platformName, '-');

            if (!PlayerDatabase::where('slug', '=', $slug)->exists()) {
                $player_database = PlayerDatabase::create([
                    'game_id'      => $row['game_id'],
                    'name'         => $row['name'],
                    'slug'         => $slug,
                ]);
                return $player_database;
            }
        }
    }
}
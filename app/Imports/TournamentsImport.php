<?php

namespace App\Imports;

use App\Tournament;
use App\Game;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
// use Maatwebsite\Excel\Concerns\WithValidation;


class TournamentsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $game = Game::find($row['game_id']);
        if ($game) {
            $gameName = $game->name;
            $platformName = $game->platform->name;
            $row['slug'] = Str::slug($row['name'] . ' ' . $gameName . ' ' . $gameName, '-');

            //check tournament
            if (!Tournament::where('slug', '=', $row['slug'])->exists()) {
                $tournament = Tournament::create([
                   'game_id'          => $row['game_id'],
                   'name'             => $row['name'],
                   'img'              => $row['img'],
                   'participant_type' => $row['participant_type'],
                   'use_teams'        => $row['use_teams'] == null ? 0 : $row['use_teams'],
                   'use_rosters'      => $row['use_rosters'] == null ? 0 : $row['use_rosters'],
                   'use_economy'      => $row['use_economy'] == null ? 0 : $row['use_economy'],
                   'user_salaries'    => $row['user_salaries'] == null ? 0 : $row['user_salaries'],
                   'use_transfers'    => $row['use_transfers'] == null ? 0 : $row['use_transfers'],
                   'use_clauses'      => $row['use_clauses'] == null ? 0 : $row['use_clauses'],
                   'use_free_agents'  => $row['use_free_agents'] == null ? 0 : $row['use_free_agents'],
                   'rules' 			  => $row['rules'],
                   'slug'             => $row['slug'],
                ]);
                return $tournament;
            }
        }
    }
}
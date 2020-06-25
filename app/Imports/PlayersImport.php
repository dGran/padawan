<?php

namespace App\Imports;

use App\Player;
use App\PlayerDatabase;
use App\GamePosition;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
// use Maatwebsite\Excel\Concerns\WithValidation;


class PlayersImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $playerDatabase = PlayerDatabase::find($row['players_databases_id']);
        if ($playerDatabase) {
        	if (!is_null($row['position_id'])) {
				$position = GamePosition::find($row['position_id']);
				if ($position) {
		            $player = Player::create([
		                'name'                 => $row['name'],
		                'players_databases_id' => $row['players_databases_id'],
		                'position_id' 		   => $row['position_id'],
		                'img'                  => $row['img'],
		                'nation_name'          => $row['nation_name'],
		                'team_name'            => $row['team_name'],
		                'league_name'          => $row['league_name'],
		                'height'               => $row['height'],
		                'age'                  => $row['age'],
		                'foot'                 => $row['foot'],
		                'overall_rating'       => $row['overall_rating'],
		                'game_id'              => $row['game_id'],
		            ]);
		            return $player;
				}
        	} else {
	            $player = Player::create([
	                'name'                 => $row['name'],
	                'players_databases_id' => $row['players_databases_id'],
	                'position_id' 		   => $row['position_id'],
	                'img'                  => $row['img'],
	                'nation_name'          => $row['nation_name'],
	                'team_name'            => $row['team_name'],
	                'league_name'          => $row['league_name'],
	                'height'               => $row['height'],
	                'age'                  => $row['age'],
	                'foot'                 => $row['foot'],
	                'overall_rating'       => $row['overall_rating'],
	                'game_id'              => $row['game_id'],
	            ]);
	            return $player;
        	}
        }
    }
}
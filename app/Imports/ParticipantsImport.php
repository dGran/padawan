<?php

namespace App\Imports;

use App\Participant;
use App\User;
use App\ETeam;
use App\Team;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class ParticipantsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
    	$import = true;
    	if ($row['user_id'] > 0) {
			$user = User::find($row['user_id']);
			if (!$user) {
				$import = false;
			}
		}
    	if ($row['eteam_id'] > 0) {
			$eteam = ETeam::find($row['eteam_id']);
			if (!$eteam) {
				$import = false;
			}
		}
    	if ($row['team_id'] > 0) {
			$team = Team::find($row['team_id']);
			if (!$team) {
				$import = false;
			}
		}
        if ($import && !Participant::where('season_id', $row['season_id'])->where('user_id', $row['user_id'])->where('eteam_id', $row['eteam_id'])->where('team_id', $row['team_id'])->exists()) {
            $participant = Participant::create([
           		'season_id' => $row['season_id'],
           		'user_id'   => $row['user_id'],
           		'eteam_id'  => $row['eteam_id'],
           		'team_id'   => $row['team_id'],
            ]);
            return $participant;
        }
    }
}
<?php

namespace App\Imports;

use App\Reserve;
use App\Participant;
use App\User;
use App\ETeam;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class ReservesImport implements ToModel, WithHeadingRow
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
        if ($import && !Reserve::where('season_id', $row['season_id'])->where('user_id', $row['user_id'])->where('eteam_id', $row['eteam_id'])->exists() && !Participant::where('season_id', $row['season_id'])->where('user_id', $row['user_id'])->where('eteam_id', $row['eteam_id'])->exists()) {
            $reserve = Reserve::create([
           		'season_id' => $row['season_id'],
           		'user_id'   => $row['user_id'],
           		'eteam_id'  => $row['eteam_id'],
            ]);
            return $reserve;
        }
    }
}
<?php

namespace App\Imports;

use App\GroupParticipant;
use App\Group;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class GroupsParticipantsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
		$group = Group::find($row['group_id']);
        if ($group) {
            $group_participant = GroupParticipant::create([
           		'phase_id'  	   => $row['group_id'],
           		'participant_id'   => $row['participant_id'],
            ]);
            return $group_participant;
        }
    }
}
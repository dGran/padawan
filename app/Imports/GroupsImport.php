<?php

namespace App\Imports;

use App\Group;
use App\Phase;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class GroupsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
		$phase = Phase::find($row['phase_id']);
        if ($phase) {
            $group = Group::create([
           		'phase_id'  	   => $row['phase_id'],
           		'name'     	       => $row['name'],
           		'num_participants' => $row['num_participants'] == null ? 0 : $row['num_participants'],
           		'active'           => $row['active'] == null ? 0 : $row['active'],
           		'slug'		       => Str::slug($row['name'], '-'),
            ]);
            return $group;
        }
    }
}
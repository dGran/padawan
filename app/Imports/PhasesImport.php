<?php

namespace App\Imports;

use App\Phase;
use App\Competition;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class PhasesImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
		$competition = Competition::find($row['competition_id']);
        if ($competition) {
            $phase = Phase::create([
           		'competition_id'   => $row['competition_id'],
           		'name'     		     => $row['name'],
           		'mode'     		     => $row['mode'],
           		'num_participants' => $row['num_participants'] == null ? 0 : $row['num_participants'],
           		'order'    		     => $row['order'],
           		'active'    	     => $row['active'] == null ? 0 : $row['active'],
           		'slug'			       => Str::slug($row['name'], '-'),
            ]);
            return $phase;
        }
    }
}
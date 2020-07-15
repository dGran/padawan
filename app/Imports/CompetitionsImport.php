<?php

namespace App\Imports;

use App\Competition;
use App\Season;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class CompetitionsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
		$season = Season::find($row['season_id']);
        if ($season) {
            $competition = Competition::create([
           		'season_id' => $row['season_id'],
           		'name'     => $row['name'],
           		'slug'		=> Str::slug($row['name'], '-'),
            ]);
            return $competition;
        }
    }
}
<?php

namespace App\Imports;

use App\Game;
use App\Platform;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class GamesImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $platform = Platform::find($row['platform_id']);
        if ($platform) {
            $platformName = $platform->name;
            $slug = Str::slug($row['name'] . ' ' . $platformName, '-');

            if (!Game::where('slug', '=', $slug)->exists()) {
                $game = Game::create([
                   'platform_id'   => $row['platform_id'],
                   'name'          => $row['name'],
                   'banner'        => $row['banner'],
                   'mode_league'   => $row['mode_league'] == null ? 0 : $row['mode_league'],
                   'mode_playoffs' => $row['mode_playoffs'] == null ? 0 : $row['mode_playoffs'],
                   'mode_races'    => $row['mode_races'] == null ? 0 : $row['mode_races'],
                   'rosters'       => $row['rosters'] == null ? 0 : $row['rosters'],
                   'positions'     => $row['positions'] == null ? 0 : $row['positions'],
                   'circuits'      => $row['circuits'] == null ? 0 : $row['circuits'],
                   'slug'          => $slug,
                ]);
                return $game;
            }
        }
    }
}
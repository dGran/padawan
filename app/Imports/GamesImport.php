<?php

namespace App\Imports;

use App\Game;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
// use Maatwebsite\Excel\Concerns\WithValidation;


class GamesImport implements ToModel, WithHeadingRow
{
    use Importable;

    // public function rules(): array
    // {
    //     return [
    //         'name' => 'required'
    //         // 'email' => 'unique:users,email',
    //     ];
    // }

    public function model(array $row)
    {
        // use manual validations because not working WithValidation
        if (!Game::where('name', $row['name'])->exists()) {
            $game = Game::create([
               'platform_id'   => $row['platform_id'],
               'name'          => $row['name'],
               'img'           => $row['img'],
               'banner'        => $row['banner'],
               'mode_league'   => $row['mode_league'],
               'mode_playoffs' => $row['mode_playoffs'],
               'mode_races'    => $row['mode_races'],
               'rosters'       => $row['rosters'],
               'rosters'       => $row['rosters'],
               'rosters'       => $row['rosters'],
               'positions'     => $row['positions'],
               'circuits'      => $row['circuits'],
               'slug'          => $row['slug'],
            ]);
            return $game;
        }

    }
}
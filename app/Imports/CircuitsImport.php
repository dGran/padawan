<?php

namespace App\Imports;

use App\GameCircuit;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
// use Maatwebsite\Excel\Concerns\WithValidation;


class CircuitsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (!GameCircuit::where('name', '=', $row['name'])->where('game_id', '=', $row['game_id'])->exists()) {
            $circuit = GameCircuit::create([
               'game_id'    => $row['game_id'],
               'name'       => $row['name'],
               'img'        => $row['img'],
            ]);
            return $circuit;
        }
    }
}
<?php

namespace App\Imports;

use App\GameCircuit;
use App\Game;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class CircuitsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $game = Game::find($row['game_id']);
        if ($game) {
            if (!GameCircuit::where('name', '=', $row['name'])->where('game_id', '=', $row['game_id'])->exists()) {
                $circuit = GameCircuit::create([
                   'game_id'    => $row['game_id'],
                   'name'       => $row['name'],
                ]);
                return $circuit;
            }
        }
    }
}
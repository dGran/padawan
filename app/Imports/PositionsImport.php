<?php

namespace App\Imports;

use App\GamePosition as Position;
use App\Game;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class PositionsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $game = Game::find($row['game_id']);
        if ($game) {
            if (!Position::where('name', '=', $row['name'])->where('game_id', '=', $row['game_id'])->exists()) {
                $position = Position::create([
                    'name'       => $row['name'],
                    'game_id'    => $row['game_id'],
                    'category'   => $row['category'],
                    'font_icon'  => $row['font_icon'],
                    'order'      => $row['order'],
                ]);
                return $position;
            }
        }
    }
}
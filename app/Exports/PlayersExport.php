<?php

namespace App\Exports;

use App\Player;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PlayersExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $players;

    public function __construct($players = null)
    {
        $this->players = $players;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->players ?: Player::all();
    }

    public function headings(): array
    {
        return [
            'id', 'players_databases_id', 'name', 'team_name', 'nation_name', 'league_name', 'position_id', 'height', 'age', 'foot', 'overall_rating', 'game_id'
        ];
    }
}
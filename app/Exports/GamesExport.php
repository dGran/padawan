<?php

namespace App\Exports;

use App\Game;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GamesExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $games;

    public function __construct($games = null)
    {
        $this->games = $games;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->games ?: Game::all();
    }

    public function headings(): array
    {
        return [
            'id', 'platform_id', 'name', 'img', 'banner', 'mode_league', 'mode_playoffs', 'mode_races', 'rosters', 'positions', 'circuits', 'slug'
        ];
    }
}

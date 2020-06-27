<?php

namespace App\Exports;

use App\Tournament;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TournamentsExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $tournaments;

    public function __construct($tournaments = null)
    {
        $this->tournaments = $tournaments;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->tournaments ?: Tournament::all();
    }

    public function headings(): array
    {
        return [
            'id', 'game_id', 'name', 'img', 'participant_type', 'use_teams', 'use_rosters', 'use_economy', 'use_salaries', 'use_transfers', 'use_clauses', 'use_free_agents', 'rules'
        ];
    }
}
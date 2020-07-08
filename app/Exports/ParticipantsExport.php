<?php

namespace App\Exports;

use App\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipantsExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $participants;

    public function __construct($participants = null)
    {
        $this->participants = $participants;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->participants ?: Participant::all();
    }

    public function headings(): array
    {
        return [
            'id', 'season_id', 'user_id', 'eteam_id', 'team_id'
        ];
    }
}

<?php

namespace App\Exports;

use App\GroupParticipant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GroupsParticipantsExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $groups_participants;

    public function __construct($groups_participants = null)
    {
        $this->groups_participants = $groups_participants;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->groups_participants ?: GroupParticipant::all();
    }

    public function headings(): array
    {
        return [
            'id', 'group_id', 'participant_id'
        ];
    }
}
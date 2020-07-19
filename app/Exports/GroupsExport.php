<?php

namespace App\Exports;

use App\Group;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GroupsExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $groups;

    public function __construct($groups = null)
    {
        $this->groups = $groups;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->groups ?: Group::all();
    }

    public function headings(): array
    {
        return [
            'id', 'phase_id', 'name', 'num_participants', 'active'
        ];
    }
}
<?php

namespace App\Exports;

use App\Phase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PhasesExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $phases;

    public function __construct($phases = null)
    {
        $this->phases = $phases;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->phases ?: Phase::all();
    }

    public function headings(): array
    {
        return [
            'id', 'competition_id', 'name', 'mode', 'num_participants', 'order', 'active'
        ];
    }
}
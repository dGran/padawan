<?php

namespace App\Exports;

use App\Competition;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompetitionsExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $competitions;

    public function __construct($competitions = null)
    {
        $this->competitions = $competitions;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->competitions ?: Competition::all();
    }

    public function headings(): array
    {
        return [
            'id', 'season_id', 'name'
        ];
    }
}
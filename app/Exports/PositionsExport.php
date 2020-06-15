<?php

namespace App\Exports;

use App\Position;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PositionsExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $positions;

    public function __construct($positions = null)
    {
        $this->positions = $positions;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->positions ?: Position::all();
    }

    public function headings(): array
    {
        return [
            'id', 'game_id', 'name', 'category', 'font_icon', 'order'
        ];
    }
}
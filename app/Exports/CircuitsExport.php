<?php

namespace App\Exports;

use App\GameCircuit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CircuitsExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $circuits;

    public function __construct($circuits = null)
    {
        $this->circuits = $circuits;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->circuits ?: GameCircuit::all();
    }

    public function headings(): array
    {
        return [
            'id', 'game_id', 'name', 'img'
        ];
    }
}
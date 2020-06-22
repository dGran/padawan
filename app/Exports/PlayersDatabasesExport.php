<?php

namespace App\Exports;

use App\PlayerDatabase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PlayersDatabasesExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $players_databases;

    public function __construct($players_databases = null)
    {
        $this->players_databases = $players_databases;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->players_databases ?: Position::all();
    }

    public function headings(): array
    {
        return [
            'id', 'game_id', 'name'
        ];
    }
}
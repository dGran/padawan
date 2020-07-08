<?php

namespace App\Exports;

use App\Reserve;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReservesExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $reserves;

    public function __construct($reserves = null)
    {
        $this->reserves = $reserves;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->reserves ?: Reserve::all();
    }

    public function headings(): array
    {
        return [
            'id', 'season_id', 'user_id', 'eteam_id'
        ];
    }
}
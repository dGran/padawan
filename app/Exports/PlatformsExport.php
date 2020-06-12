<?php

namespace App\Exports;

use App\Platform;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PlatformsExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $platforms;

    public function __construct($platforms = null)
    {
        $this->platforms = $platforms;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->platforms ?: Platform::all();
    }

    public function headings(): array
    {
        return [
            'id', 'name', 'img'
        ];
    }
}

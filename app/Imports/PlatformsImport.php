<?php

namespace App\Imports;

use App\Platform;
use Illuminate\Support\Str;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
// use Maatwebsite\Excel\Concerns\WithValidation;


class PlatformsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        if (!Platform::where('name', $row['name'])->exists()) {
            $platform = Platform::create([
               'name'   => $row['name'],
               'img'    => $row['img'],
               'slug'   => Str::slug($row['name'], '-'),
            ]);
            return $platform;
        }
    }
}
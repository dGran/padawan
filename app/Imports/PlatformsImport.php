<?php

namespace App\Imports;

use App\Platform;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
// use Maatwebsite\Excel\Concerns\WithValidation;


class PlatformsImport implements ToModel, WithHeadingRow
{
    use Importable;

    // public function rules(): array
    // {
    //     return [
    //         'name' => 'required'
    //         // 'email' => 'unique:users,email',
    //     ];
    // }

    public function model(array $row)
    {
        // use manual validations because not working WithValidation
        if (!Plaform::where('name', $row['name'])->exists()) {
            $platform = Platform::create([
               'name'     => $row['name'],
               'img'    => $row['img'],
            ]);
            return $platform;
        }

    }
}
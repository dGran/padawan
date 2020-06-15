<?php

namespace App\Imports;

use App\Position;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
// use Maatwebsite\Excel\Concerns\WithValidation;


class PositionsImport implements ToModel, WithHeadingRow
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
        if (!Position::where('name', $row['name'])->exists()) {
            $position = Position::create([
            	'name'       => $row['name'],
				'game_id'    => $row['game_id'],
				'category'   => $row['category'],
				'font_icon'  => $row['font_icon'],
				'order'      => $row['order'],
            ]);
            return $position;
        }

    }
}
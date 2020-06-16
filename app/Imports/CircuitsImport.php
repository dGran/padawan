<?php

namespace App\Imports;

use App\GameCircuit;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
// use Maatwebsite\Excel\Concerns\WithValidation;


class CircuitsImport implements ToModel, WithHeadingRow
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
        // if (!GameCircuit::where('name', $row['name'])->exists()) {
            $circuit = GameCircuit::create([
               'game_id'    => $row['game_id'],
               'name'       => $row['name'],
               'img'        => $row['img'],
            ]);
            return $circuit;
        // }
    }
}
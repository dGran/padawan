<?php

namespace App\Imports;

use App\User;
use App\Profile;
use Illuminate\Support\Facades\Hash;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
// use Maatwebsite\Excel\Concerns\WithValidation;


class UsersImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        // use manual validations because not working WithValidation
        if (!User::where('email', $row['email'])->where('name', $row['name'])->exists()) {
            $user = User::create([
               'name'     => $row['name'],
               'email'    => $row['email'],
               'email_verified_at' => $row['email_verified_at'],
               'is_admin' => $row['is_admin'] ?: 0,
               'created_at' => $row['created_at'],
               'updated_at' => $row['updated_at'],
               'password' => Hash::make('secret'),
            ]);
            $user->profile()->save(new Profile);
            return $user;
        }

    }
}

<?php

namespace App\Imports;

use App\User;
use App\Profile;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::create([
           'name'     => $row[1] . '_import_' . rand(100,999),
           'email'    => $row[2] . '_import_' . rand(100,999),
           'email_verified_at' => $row[5],
           'is_admin' => $row[4],
           'created_at' => $row[5],
           'updated_at' => $row[6],
           'password' => Hash::make('secret'),
        ]);
        $user->profile()->save(new Profile);
        return $user;
    }
}

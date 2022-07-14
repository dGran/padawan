<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $accesAdminPanelpermission = Permission::create(['name' => 'access admin panel']);
        $accesAdminPanelpermission->assignRole([$superAdminRole, $adminRole]);

        $user = User::create([
            'name' => 'marcel',
            'email' => 'marcel@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user->assignRole('super-admin');
        Profile::create([
            'user_id' => $user->id
        ]);

        $user = User::create([
            'name' => 'pAdRoNe',
            'email' => 'dgranh@gmail.com',
            'password' => Hash::make('corleone'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user->assignRole('admin');
        Profile::create([
            'user_id' => $user->id
        ]);

        for ($i=1; $i < 50; $i++) {
            $name = 'user_test_' . $i;
            $user = User::create([
                'name' => $name,
                'email' => $name . '@gmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => now(),
                'created_at' => now()->addMinutes($i),
                'updated_at' => now()->addMinutes($i),
            ]);
            Profile::create([
                'user_id' => $user->id
            ]);
        }
    }
}

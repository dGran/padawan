<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(GameSeeder::class);
        $this->call(CountrySeeder::class);
        \App\Models\User::factory(150)->create();
        \App\Models\ETeam::factory(25)->create();
        \App\Models\ETeamPost::factory(10)->create();
    }
}

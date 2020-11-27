<?php

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
        $this->call(CountriesSeeder::class);

        $this->call(PlatformSeeder::class);
        $this->call(GameSeeder::class);
        $this->call(GamePositionSeeder::class);
        $this->call(GameCircuitSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(PlayerDatabaseSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(eTeamSeeder::class);
    }
}

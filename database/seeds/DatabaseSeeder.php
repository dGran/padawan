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
        $this->call(UserSeeder::class);
        $this->call(PlatformSeeder::class);
        $this->call(GameSeeder::class);
        $this->call(GamePositionSeeder::class);
        $this->call(GameCircuitSeeder::class);
        $this->call(PlayerDatabaseSeeder::class);
        $this->call(eTeamSeeder::class);
        $this->call(TeamSeeder::class);
    }
}

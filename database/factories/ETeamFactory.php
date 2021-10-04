<?php

namespace Database\Factories;

use App\Models\ETeam;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ETeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ETeam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word();
        return [
            'game_id' => 1,
            'name' => $name,
            'short_name' => strtoupper(substr($name, 0, 3)),
            // 'country_id' => 209,
            'location' => $this->faker->city(),
            'presentation' => $this->faker->text(),
            'presentation_video' => '3CD1jIT6aHQ',
            'created_at' => now(),
            'updated_at' => now(),
            'slug' => Str::slug($name, '-'),
        ];
    }
}

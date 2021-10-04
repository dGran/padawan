<?php

namespace Database\Factories;

use App\Models\ETeamPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ETeamPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ETeamPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->text(20);
        return [
            'eteam_id' => 1,
            'user_id' => 1,
            'title' => $title,
            'content' => $this->faker->text(),
            'slug' => Str::slug($title, '-'),
        ];
    }
}

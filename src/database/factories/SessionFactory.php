<?php

namespace Database\Factories;

use App\Models\Session;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'started_at' => $this->faker->dateTimeThisYear(),
            'completed_at' => $this->faker->dateTimeThisYear(),
            'total_score' => $this->faker->numberBetween(0, 1000),
        ];
    }
}

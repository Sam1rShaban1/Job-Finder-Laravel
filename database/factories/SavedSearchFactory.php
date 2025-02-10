<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SavedSearch>
 */
class SavedSearchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'search_query' => $this->faker->words(3, true),
            'filters' => json_encode(['type' => $this->faker->randomElement(['full-time', 'part-time'])]),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}

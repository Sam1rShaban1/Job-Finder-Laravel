<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SavedJob>
 */
class SavedJobFactory extends Factory
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
            'job_listing_id' => \App\Models\JobListing::factory(),
            'saved_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}

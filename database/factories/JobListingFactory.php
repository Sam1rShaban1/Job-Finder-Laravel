<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobListing>
 */
class JobListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph,
            'employer_id' => Employer::factory(),
            'type' => $this->faker->randomElement(['full-time', 'part-time', 'contract', 'internship']),
            'requirements' => $this->faker->words(5),
            'closing_date' => $this->faker->dateTimeBetween('+1 week', '+2 months'),
            'salary_range' => [
                'min' => $this->faker->numberBetween(30000, 50000),
                'max' => $this->faker->numberBetween(60000, 1000000)
            ],
            'location' => $this->faker->city,
            'experience_level' => $this->faker->randomElement(['entry', 'mid', 'senior', 'lead'])
        ];
    }
}

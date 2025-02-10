<?php

namespace Database\Factories;

use App\Models\JobListing;
use App\Models\JobPerformance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPerformance>
 */
class JobPerformanceFactory extends Factory
{
    protected $model = JobPerformance::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_listing_id' => JobListing::factory(),
            'views' => $this->faker->numberBetween(0, 1000),
            'applications' => $this->faker->numberBetween(0, 500),
            'hired_count' => $this->faker->numberBetween(0, 50),
        ];
    }
}

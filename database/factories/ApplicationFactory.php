<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\User;
use App\Models\JobListing;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'job_listing_id' => JobListing::factory(),
            'cover_letter' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(Application::STATUSES),
            'applied_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
} 
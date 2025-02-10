<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Interview;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interview>
 */
class InterviewFactory extends Factory
{
    protected $model = Interview::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'application_id' => Application::factory(),
            'scheduled_at' => $this->faker->dateTimeBetween('+1 week', '+2 months'),
            'interview_type' => $this->faker->randomElement(['in-person', 'virtual', 'phone']),
            'location' => $this->faker->address,
            'notes' => $this->faker->paragraph,
        ];
    }
}

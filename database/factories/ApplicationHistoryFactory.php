<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\ApplicationHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ApplicationHistory>
 */
class ApplicationHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApplicationHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = [
            'pending',
            'submitted',
            'under_review',
            'shortlisted',
            'interviewed',
            'offered',
            'accepted',
            'rejected',
            'withdrawn'
        ];

        $status = $this->faker->randomElement($statuses);
        $previous_status = $this->faker->randomElement(array_filter($statuses, fn($s) => $s !== $status));

        return [
            'application_id' => Application::factory(),
            'status' => $status,
            'previous_status' => $previous_status,
            'remarks' => $this->faker->sentence(),
            'changed_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function submitted()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'submitted',
                'previous_status' => null,
                'remarks' => 'Application submitted'
            ];
        });
    }

    public function withdrawn()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'withdrawn',
                'previous_status' => 'submitted',
                'remarks' => 'Application withdrawn by jobfinder'
            ];
        });
    }
}

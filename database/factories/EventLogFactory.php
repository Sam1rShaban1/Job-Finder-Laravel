<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventLog>
 */
class EventLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_name' => $this->faker->randomElement(['user_login', 'job_application', 'profile_update']),
            'event_type' => $this->faker->randomElement(['system', 'user', 'error']),
            'event_data' => json_encode([
                'user_id' => $this->faker->numberBetween(1, 10),
                'details' => $this->faker->sentence(),
            ]),
            'ip_address' => $this->faker->ipv4,
        ];
    }
}

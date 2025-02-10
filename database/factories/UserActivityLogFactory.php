<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserActivityLog>
 */
class UserActivityLogFactory extends Factory
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
            'activity_type' => $this->faker->randomElement(['login', 'logout', 'profile_update']),
            'ip_address' => $this->faker->ipv4,
            'description' => $this->faker->sentence,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ UserEngagement>
 */
class UserEngagementFactory extends Factory
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
            'score' => $this->faker->numberBetween(1, 100),
            'engagement_details' => $this->faker->randomElement([
                json_encode(['comments' => 5, 'likes' => 10]),
                json_encode(['shares' => 2, 'bookmarks' => 8]),
            ]),
        ];
    }
}
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_id' => \App\Models\User::factory(),
            'receiver_id' => \App\Models\User::factory(),
            'content' => $this->faker->text,
            'sent_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'is_read' => $this->faker->boolean,
        ];
    }
}

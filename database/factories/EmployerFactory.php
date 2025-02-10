<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
 */
class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company,
            'email' => $this->faker->unique()->companyEmail,
            'phone_number' => $this->faker->phoneNumber,
            'website_url' => $this->faker->url,
            'address' => $this->faker->address,
            'description' => $this->faker->paragraph,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Certification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificationFactory extends Factory
{
    protected $model = Certification::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->randomElement(['AWS Certified Solutions Architect', 'CISSP', 'PMP', 'CCNA', 'CompTIA A+']),
            'issuing_organization' => $this->faker->company,
            'issue_date' => $this->faker->dateTimeBetween('-2 years', '-6 months'),
            'expiry_date' => $this->faker->dateTimeBetween('+6 months', '+2 years'),
            'credential_id' => $this->faker->uuid,
            'credential_url' => $this->faker->url,
        ];
    }
} 
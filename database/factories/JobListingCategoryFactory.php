<?php

namespace Database\Factories;

use App\Models\JobListing;
use App\Models\JobCategory;
use App\Models\JobListingCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobListingCategory>
 */
class JobListingCategoryFactory extends Factory
{
    protected $model = JobListingCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_listing_id' => JobListing::factory(),
            'job_category_id' => JobCategory::factory(),
        ];
    }
}

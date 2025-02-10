<?php

namespace Database\Seeders;

use App\Models\JobListing;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobListingsSearchableSeeder extends Seeder
{
    public function run()
    {
        $jobListings = JobListing::all();

        foreach ($jobListings as $jobListing) {
            DB::table('job_listings_searchable')->insert([
                'job_listing_id' => $jobListing->id,
                'searchable_text' => $jobListing->title . ' ' . $jobListing->description . ' ' . $jobListing->location,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}


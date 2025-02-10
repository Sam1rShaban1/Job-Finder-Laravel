<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\User;
use App\Models\Application;
use App\Models\ApplicationHistory;
use App\Models\CompanyReview;
use App\Models\Employer;
use App\Models\EventLog;
use App\Models\Interview;
use App\Models\JobCategory;
use App\Models\JobListing;
use App\Models\JobListingCategory;
use App\Models\JobPerformance;
use App\Models\JobType;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Preference;
use App\Models\SavedJob;
use App\Models\SavedSearch;
use App\Models\UserActivityLog;
use App\Models\UserEngagement;
use App\Models\UserSkill;
use App\Models\Certification;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Base tables (no foreign key dependencies)
        User::factory(10)->create();
        Employer::factory(10)->create();
        JobCategory::factory(10)->create();
        JobType::factory(10)->create();

        // Create skills for each user with correct enum values
        User::all()->each(function ($user) {
            Skill::factory(3)->create([
                'user_id' => $user->id,
                'proficiency' => fake()->randomElement(['Junior', 'Intermediate', 'Senior'])
            ]);
        });

        // First level dependencies
        JobListing::factory(100)->create();  // depends on employer
        Certification::factory(30)->create(); // depends on user
        
        // Second level dependencies
        JobListingCategory::factory(10)->create();  // depends on job_listing and job_category
        Application::factory(10)->create();  // depends on user and job_listing
        
        // Third level dependencies
        ApplicationHistory::factory(10)->create();  // depends on application
        Interview::factory(10)->create();  // depends on application
        SavedJob::factory(10)->create();  // depends on user and job_listing
        UserSkill::factory(10)->create();  // depends on user and skill
        CompanyReview::factory(10)->create();  // depends on user and employer
        
        // Auxiliary data
        EventLog::factory(10)->create();
        Message::factory(10)->create();
        Notification::factory(10)->create();
        Preference::factory(10)->create();
        SavedSearch::factory(10)->create();
        UserActivityLog::factory(10)->create();
        UserEngagement::factory(10)->create();
        JobPerformance::factory(10)->create();
        Certification::factory(10)->create();
        JobPerformance::factory(10)->create();
    }
}

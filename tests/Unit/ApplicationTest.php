<?php 
namespace Tests\Unit;

use App\Models\Application;
use App\Models\User;
use App\Models\JobListing;
use App\Models\ApplicationHistory;
use App\Models\Interview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Tests\TestCase;  // Change this from PHPUnit\Framework\TestCase
use Carbon\Carbon;

class ApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_application_creation()
    {
        // Arrange
        $user = User::factory()->create();
        $jobListing = JobListing::factory()->create();
        $now = now();
        
        $applicationData = [
            'user_id' => $user->id,
            'job_listing_id' => $jobListing->id,
            'cover_letter' => 'This is a test cover letter',
            'status' => 'submitted',
            'applied_at' => $now
        ];

        // Act
        $application = Application::create($applicationData);

        // Assert
        $this->assertInstanceOf(Application::class, $application);
        $this->assertEquals($applicationData['user_id'], $application->user_id);
        $this->assertEquals($applicationData['job_listing_id'], $application->job_listing_id);
        $this->assertEquals($applicationData['cover_letter'], $application->cover_letter);
        $this->assertEquals($applicationData['status'], $application->status);
        $this->assertInstanceOf(Carbon::class, $application->applied_at);
    }

    public function test_user_relationship()
    {
        // Arrange
        $user = User::factory()->create();
        $application = Application::factory()->create(['user_id' => $user->id]);

        // Act
        $relatedUser = $application->user;

        // Assert
        $this->assertInstanceOf(User::class, $relatedUser);
        $this->assertEquals($user->id, $relatedUser->id);
    }

    public function test_job_listing_relationship()
    {
        // Arrange
        $jobListing = JobListing::factory()->create();
        $application = Application::factory()->create(['job_listing_id' => $jobListing->id]);

        // Act
        $relatedJobListing = $application->jobListing;

        // Assert
        $this->assertInstanceOf(JobListing::class, $relatedJobListing);
        $this->assertEquals($jobListing->id, $relatedJobListing->id);
    }

    public function test_history_relationship()
    {
        // Arrange
        $application = Application::factory()->create();
        $history = ApplicationHistory::factory()->create(['application_id' => $application->id]);

        // Act
        $relatedHistory = $application->history;

        // Assert
        $this->assertInstanceOf(Collection::class, $relatedHistory);
        $this->assertCount(1, $relatedHistory);
        $this->assertEquals($history->id, $relatedHistory->first()->id);
    }

    public function test_application_status_update_creates_history()
    {
        $application = Application::factory()->create(['status' => 'submitted']);
        $oldStatus = $application->status;
        
        $application->update(['status' => 'in_review']);
        
        $history = $application->history()->latest()->first();
        $this->assertNotNull($history);
        $this->assertEquals($oldStatus, $history->previous_status);
        $this->assertEquals('in_review', $history->status);
    }

    public function test_application_with_interview()
    {
        $application = Application::factory()->create();
        $interview = Interview::factory()->create([
            'application_id' => $application->id,
            'scheduled_at' => now()->addDays(5)
        ]);

        $this->assertInstanceOf(Interview::class, $application->interview);
        $this->assertTrue($application->hasScheduledInterview());
    }

    public function test_scope_pending()
    {
        Application::factory()->count(3)->create(['status' => 'pending']);
        Application::factory()->count(2)->create(['status' => 'accepted']);

        $pendingApplications = Application::pending()->get();

        $this->assertCount(3, $pendingApplications);
        $pendingApplications->each(function ($application) {
            $this->assertEquals('pending', $application->status);
        });
    }

    public function test_scope_by_date_range()
    {
        $oldApplication = Application::factory()->create([
            'applied_at' => now()->subDays(10)
        ]);
        
        $newApplication = Application::factory()->create([
            'applied_at' => now()->subDay()
        ]);

        $applications = Application::byDateRange(
            now()->subDays(7),
            now()
        )->get();

        $this->assertCount(1, $applications);
        $this->assertEquals($newApplication->id, $applications->first()->id);
    }
}
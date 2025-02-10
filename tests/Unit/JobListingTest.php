<?php
namespace Tests\Unit;

use App\Models\JobListing;
use App\Models\Employer;
use App\Models\Application;
use App\Models\JobListingCategory;
use App\Models\JobPerformance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Tests\TestCase;  // Change this from PHPUnit\Framework\TestCase
use Carbon\Carbon;

class JobListingTest extends TestCase
{
    use RefreshDatabase;

    public function test_job_listing_creation()
    {
        // Arrange
        $employer = Employer::factory()->create();
        $closingDate = Carbon::parse('2023-03-01');
        
        $jobListingData = [
            'title' => 'Software Engineer',
            'description' => 'Test description',
            'employer_id' => $employer->id,
            'type' => 'full-time',
            'requirements' => ['PHP', 'Laravel'],
            'closing_date' => $closingDate
        ];

        // Act
        $jobListing = JobListing::create($jobListingData);

        // Assert
        $this->assertInstanceOf(JobListing::class, $jobListing);
        $this->assertEquals($jobListingData['title'], $jobListing->title);
        $this->assertEquals($jobListingData['description'], $jobListing->description);
        $this->assertEquals($jobListingData['employer_id'], $jobListing->employer_id);
        $this->assertEquals($jobListingData['type'], $jobListing->type);
        $this->assertEquals($jobListingData['requirements'], $jobListing->requirements);
        $this->assertTrue($jobListingData['closing_date']->equalTo($jobListing->closing_date));
    }

    public function test_employer_relationship()
    {
        // Arrange
        $employer = Employer::factory()->create();
        $jobListing = JobListing::factory()->create(['employer_id' => $employer->id]);

        // Act
        $relatedEmployer = $jobListing->employer;

        // Assert
        $this->assertInstanceOf(Employer::class, $relatedEmployer);
        $this->assertEquals($employer->id, $relatedEmployer->id);
    }

    public function test_applications_relationship()
    {
        // Arrange
        $jobListing = JobListing::factory()->create();
        $application = Application::factory()->create(['job_listing_id' => $jobListing->id]);

        // Act
        $relatedApplications = $jobListing->applications;

        // Assert
        $this->assertInstanceOf(Collection::class, $relatedApplications);
        $this->assertCount(1, $relatedApplications);
        $this->assertEquals($application->id, $relatedApplications->first()->id);
    }

    public function test_categories_relationship()
    {
        // Arrange
        $jobListing = JobListing::factory()->create();
        $category = JobListingCategory::factory()->create(['job_listing_id' => $jobListing->id]);

        // Act
        $relatedCategories = $jobListing->categories;

        // Assert
        $this->assertInstanceOf(Collection::class, $relatedCategories);
        $this->assertCount(1, $relatedCategories);
        $this->assertEquals($category->id, $relatedCategories->first()->id);
    }

    public function test_performance_relationship()
    {
        // Arrange
        $jobListing = JobListing::factory()->create();
        $performance = JobPerformance::factory()->create(['job_listing_id' => $jobListing->id]);

        // Act
        $relatedPerformance = $jobListing->performance;

        // Assert
        $this->assertInstanceOf(JobPerformance::class, $relatedPerformance);
        $this->assertEquals($performance->id, $relatedPerformance->id);
    }

    public function test_scope_active()
    {
        JobListing::factory()->create([
            'closing_date' => now()->addDays(5)
        ]);
        
        JobListing::factory()->create([
            'closing_date' => now()->subDays(5)
        ]);

        $activeListings = JobListing::active()->count();
        $this->assertEquals(1, $activeListings);
    }

    public function test_job_performance_tracking()
    {
        $jobListing = JobListing::factory()->create();
        
        JobPerformance::create([
            'job_listing_id' => $jobListing->id,
            'views' => 100,
            'applications' => 10,
            'hired_count' => 2
        ]);

        $this->assertInstanceOf(JobPerformance::class, $jobListing->performance);
        $this->assertEquals(100, $jobListing->performance->views);
        $this->assertEquals(10, $jobListing->performance->applications);
    }

    public function test_search_by_title()
    {
        JobListing::factory()->create(['title' => 'Senior PHP Developer']);
        
        $results = JobListing::search('PHP')->get();
        
        $this->assertCount(1, $results);
        $this->assertEquals('Senior PHP Developer', $results->first()->title);
    }

    public function test_filter_by_type()
    {
        JobListing::factory()->count(2)->create(['type' => 'full-time']);
        JobListing::factory()->create(['type' => 'part-time']);
        
        $fullTimeJobs = JobListing::byType('full-time')->get();
        
        $this->assertCount(2, $fullTimeJobs);
    }
}
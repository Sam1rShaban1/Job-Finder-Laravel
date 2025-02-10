<?php

namespace Tests\Feature\Mail;

use Tests\TestCase;
use App\Models\User;
use App\Models\Application;
use App\Mail\AppliedMail;
use App\Mail\AcceptedMail;
use App\Mail\RejectedMail;
use App\Mail\InterviewScheduledMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MailApplicationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Mail::fake();
    }

    public function test_applied_email_is_sent()
    {
        $user = User::factory()->create(['role' => 'employer']);
        $this->actingAs($user);

        $application = Application::factory()->create(['user_id' => $user->id]);

        $response = $this->post(route('applications.send.applied.email', $application));

        Mail::assertSent(AppliedMail::class, function ($mail) use ($application) {
            return $mail->hasTo($application->user->email) &&
                   $mail->mailData['title'] === 'Application Notification' &&
                   $mail->mailData['jobSeekerName'] === $application->user->name &&
                   $mail->mailData['jobTitle'] === $application->job->title &&
                   $mail->mailData['companyName'] === $application->job->company->name &&
                   $mail->mailData['dashboardLink'] === route('dashboard');
        });

        $response->assertRedirect()->with('success', 'Email sent successfully');
    }

    public function test_accepted_email_is_sent()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $application = Application::factory()->create(['user_id' => $user->id]);

        $response = $this->post(route('applications.send.accepted.email', $application));

        Mail::assertSent(AcceptedMail::class, function ($mail) use ($application) {
            return $mail->mailData['title'] === 'Congratulations!' &&
                   $mail->mailData['jobSeekerName'] === $application->user->name &&
                   $mail->mailData['jobTitle'] === $application->job->title &&
                   $mail->mailData['companyName'] === $application->job->company->name;
        });

        $response->assertRedirect()->with('success', 'Accepted email sent successfully');
    }

    public function test_rejected_email_is_sent()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $application = Application::factory()->create(['user_id' => $user->id]);

        $response = $this->post(route('applications.send.rejected.email', $application));

        Mail::assertSent(RejectedMail::class, function ($mail) use ($application) {
            return $mail->mailData['title'] === 'Application Update' &&
                   $mail->mailData['jobSeekerName'] === $application->user->name &&
                   $mail->mailData['jobTitle'] === $application->job->title &&
                   $mail->mailData['companyName'] === $application->job->company->name &&
                   $mail->mailData['jobBoardLink'] === route('job-listings.index');
        });

        $response->assertRedirect()->with('success', 'Rejected email sent successfully');
    }

    public function test_interview_scheduled_email_is_sent()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $application = Application::factory()->create(['user_id' => $user->id]);

        $response = $this->post(route('applications.send.interview.scheduled.email', $application));

        Mail::assertSent(InterviewScheduledMail::class, function ($mail) use ($application) {
            $interview = $application->interview; // Assuming the interview is already scheduled and exists
            return $mail->mailData['title'] === 'Interview Scheduled' &&
                   $mail->mailData['jobSeekerName'] === $application->user->name &&
                   $mail->mailData['jobTitle'] === $application->job->title &&
                   $mail->mailData['companyName'] === $application->job->company->name &&
                   $mail->mailData['interviewDate'] === $interview->scheduled_at->format('Y-m-d') &&
                   $mail->mailData['interviewTime'] === $interview->scheduled_at->format('g:i A') &&
                   $mail->mailData['interviewLocation'] === $interview->location &&
                   $mail->mailData['contactPerson'] === $application->job->employer->name &&
                   $mail->mailData['contactEmail'] === $application->job->employer->email;
        });

        $response->assertRedirect()->with('success', 'Interview scheduled email sent successfully');
    }
} 
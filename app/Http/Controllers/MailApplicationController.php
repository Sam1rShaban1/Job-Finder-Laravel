<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AppliedMail;
use App\Mail\AcceptedMail;
use App\Mail\RejectedMail;
use App\Mail\InterviewScheduledMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Application;

class MailApplicationController extends Controller
{
    // public function sendAppliedEmail(Request $request, Application $application)
    // {
    //     $maildata = [
    //         'title' => 'Application Notification',
    //         'jobSeekerName' => $application->user->name,
    //         'jobTitle' => $application->job->title,
    //         'companyName' => $application->job->company->name,
    //         'dashboardLink' => route('dashboard'),
    //     ];

    //     Mail::to('mi31148@seeu.edu.mk')->send(new AppliedMail($maildata));
    //     return redirect()->back()->with('success', 'Email sent successfully');
    // }

    public function sendAppliedEmail(Request $request, Application $application)
{
    if (!$application) {
        return response()->json(['error' => 'Application not found'], 404);
    }

    return response()->json(['message' => 'Application found', 'data' => $application]);
}

    public function sendAcceptedEmail(Request $request, Application $application)
    {
        $maildata = [
            'title' => 'Congratulations!',
            'jobSeekerName' => $application->user->name,
            'jobTitle' => $application->job->title,
            'companyName' => $application->job->company->name,
        ];

        Mail::to($application->user->email)->send(new AcceptedMail($maildata));
        return redirect()->back()->with('success', 'Accepted email sent successfully');
    }

    public function sendRejectedEmail(Request $request, Application $application)
    {
        $maildata = [
            'title' => 'Application Update',
            'jobSeekerName' => $application->user->name,
            'jobTitle' => $application->job->title,
            'companyName' => $application->job->company->name,
            'jobBoardLink' => route('job-listings.index'),
        ];

        Mail::to($application->user->email)->send(new RejectedMail($maildata));
        return redirect()->back()->with('success', 'Rejected email sent successfully');
    }

    public function sendInterviewScheduledEmail(Request $request, Application $application)
    {
        // Assuming the interview is already scheduled and exists
        $interview = $application->interview;

        $maildata = [
            'title' => 'Interview Scheduled',
            'jobSeekerName' => $application->user->name,
            'jobTitle' => $application->job->title,
            'companyName' => $application->job->company->name,
            'interviewDate' => $interview->scheduled_at->format('Y-m-d'),
            'interviewTime' => $interview->scheduled_at->format('g:i A'),
            'timeZone' => \Carbon\Carbon::now()->tz(config('app.timezone'))->toString(),
            'interviewLocation' => $interview->location,
            'contactPerson' => $application->job->employer->name,
            'contactEmail' => $application->job->employer->email,
        ];

        Mail::to($application->user->email)->send(new InterviewScheduledMail($maildata));
        return redirect()->back()->with('success', 'Interview scheduled email sent successfully');
    }
}

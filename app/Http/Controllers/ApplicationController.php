<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;
use App\Models\Application;
use App\Http\Requests\JobApplicationRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppliedMail;

class ApplicationController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard_Job_Finder/ApplicationsDashboard/DashboardApplications', [
            'applications' => Application::where('user_id', Auth::id())
                ->with(['jobListing.employer'])
                ->latest()
                ->get()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'job_listing_id' => 'required|exists:job_listings,id',
            'cover_letter' => 'required|string',
        ]);

        $application = Application::create([
            'user_id' => auth()->id(),
            'job_listing_id' => $validatedData['job_listing_id'],
            'cover_letter' => $validatedData['cover_letter'],
            'status' => 'submitted',
            'applied_at' => now(),
        ]);

        // Call the MailApplicationController to send the email
        $mailController = new MailApplicationController();
        $mailController->sendAppliedEmail($request, $application);

        return redirect()->route('dashboard')->with('success', 'Application submitted successfully!');
    }

    public function withdraw(Application $application)
    {
        $this->authorize('update', $application);
        
        $application->update(['status' => 'withdrawn']);
        return back()->with('status', 'Application withdrawn');
    }
}

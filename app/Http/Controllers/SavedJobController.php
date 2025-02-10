<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\StoreSavedJobRequest;
use App\Models\SavedJob;

class SavedJobController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(): Response
    {
        return Inertia::render('Dashboard_Job_Finder/SavedJobsDashboard/DashboardSavedJobs', [
            'savedJobs' => auth()->user()->savedJobs()
                ->with('jobListing.employer')
                ->latest()
                ->paginate(10)
        ]);
    }

    public function store(StoreSavedJobRequest $request): RedirectResponse
    {
        auth()->user()->savedJobs()->create([
            'job_listing_id' => $request->validated()['job_id'],
            'notes' => $request->validated()['notes'],
            'saved_at' => now()
        ]);

        return back()->with('success', 'Job saved successfully');
    }

    public function update(StoreSavedJobRequest $request, SavedJob $savedJob): RedirectResponse
    {
        $this->authorize('update', $savedJob);
        
        $savedJob->update([
            'notes' => $request->validated()['notes']
        ]);
        
        return back()->with('success', 'Saved job updated');
    }

    public function destroy(SavedJob $savedJob): RedirectResponse
    {
        $this->authorize('delete', $savedJob);
        $savedJob->delete();
        
        return back()->with('success', 'Saved job removed');
    }
}

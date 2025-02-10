<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class JobListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch jobs with employer relationship, so you can access job.employer.name in React
        $jobs = JobListing::with('employer')->get(); 

        // Return Inertia view 'Home/Home' with jobs data
        return Inertia::render('Home/Home', [
            'jobs' => $jobs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Employer/JobListingForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:full-time,part-time,contract',
            'salary_range' => 'nullable|string',
            'requirements' => 'required|array|min:1',
            'closing_date' => 'required|date|after:today'
        ]);

        auth()->user()->employer->jobListings()->create($validated);

        return redirect()->route('employers.jobs.index')
            ->with('success', 'Job listing created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobListing $job): Response
    {
        return Inertia::render('Jobs/Show', [
            'job' => $job->load('employer'),
            'hasApplied' => auth()->check() && auth()->user()->hasAppliedTo($job)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobListing $job): Response
    {
        Gate::authorize('update', $job);
        
        return Inertia::render('Employer/JobListingForm', [
            'listing' => $job
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobListing $job): RedirectResponse
    {
        Gate::authorize('update', $job);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:full-time,part-time,contract',
            'salary_range' => 'nullable|string',
            'requirements' => 'required|array|min:1',
            'closing_date' => 'required|date|after:today'
        ]);

        $job->update($validated);

        return redirect()->route('employers.jobs.index')
            ->with('success', 'Job listing updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobListing $job): RedirectResponse
    {
        Gate::authorize('delete', $job);
        
        $job->delete();
        return back()->with('success', 'Job listing deleted');
    }
}

<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\JobListing;

class JobDetailsController extends Controller
{
    public function show(JobListing $job): Response
    {
        return Inertia::render('JobDetails/JobDetails', [
            'job' => $job->load(['employer', 'categories']),
            'relatedJobs' => JobListing::where('employer_id', $job->employer_id)
                ->where('id', '!=', $job->id)
                ->with('employer')
                ->limit(4)
                ->get()
        ]);
    }
} 
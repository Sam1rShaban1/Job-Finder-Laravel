<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\JobCategory;
use App\Models\JobListingCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\Inertia;

class JobListingCategoryController extends Controller
{
    public function index(JobListing $jobListing): Response
    {
        return Inertia::render('JobListings/Categories', [
            'jobListing' => $jobListing->load('categories'),
            'availableCategories' => JobCategory::all()
        ]);
    }

    public function store(Request $request, JobListing $jobListing): RedirectResponse
    {
        $validated = $request->validate([
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:job_categories,id'
        ]);

        foreach ($validated['category_ids'] as $categoryId) {
            JobListingCategory::create([
                'job_listing_id' => $jobListing->id,
                'job_category_id' => $categoryId
            ]);
        }

        return back()->with('success', 'Categories added successfully');
    }

    public function destroy(JobListing $jobListing, JobCategory $category): RedirectResponse
    {
        $this->authorize('update', $jobListing);
        
        JobListingCategory::where('job_listing_id', $jobListing->id)
            ->where('job_category_id', $category->id)
            ->delete();

        return back()->with('success', 'Category removed from job listing');
    }
} 
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\CompanyReview;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(): Response
    {
        return Inertia::render('Reviews/Index', [
            'reviews' => CompanyReview::with(['user', 'employer'])
                ->latest()
                ->paginate(10)
        ]);
    }

    public function show(CompanyReview $review): Response
    {
        return Inertia::render('Reviews/Show', [
            'review' => $review->load(['user.profile', 'employer'])
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'rating' => 'required|integer|between:1,5',
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:1000'
        ]);

        auth()->user()->reviews()->create($validated);

        return back()->with('success', 'Review submitted successfully');
    }

    public function update(Request $request, CompanyReview $review): RedirectResponse
    {
        $this->authorize('update', $review);
        
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'content' => 'required|string|max:1000'
        ]);
        
        $review->update($validated);
        
        return back()->with('success', 'Review updated successfully');
    }

    public function destroy(CompanyReview $review): RedirectResponse
    {
        $this->authorize('delete', $review);
        $review->delete();
        
        return back()->with('success', 'Review deleted successfully');
    }
}

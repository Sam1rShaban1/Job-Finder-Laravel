<?php

namespace App\Http\Controllers;
use App\Http\Requests\CompanyReviewRequest;
use App\Models\Employer;
use Illuminate\Http\Request;
use App\Models\CompanyReview;

class CompanyReviewController extends Controller
{
    public function store(CompanyReviewRequest $request, Employer $employer)
    {
        $review = $employer->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'title' => $request->title,
            'content' => $request->content,
            'review_text' => $request->content
        ]);

        return back()->with('status', 'Review submitted!');
    }

    public function update(Request $request, CompanyReview $review)
    {
        $this->authorize('update', $review);
        
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'content' => 'required|string|max:1000'
        ]);
        
        $review->update($validated);
        
        return back()->with('status', 'Review updated');
    }

    public function destroy(CompanyReview $review)
    {
        $this->authorize('delete', $review);
        $review->delete();
        return back()->with('status', 'Review deleted');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\StoreUserEngagementRequest;
use App\Models\UserEngagement;

class UserEngagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(): Response
    {
        return Inertia::render('Dashboard_Job_Finder/EngagementDashboard/DashboardEngagement', [
            'engagements' => auth()->user()->engagements()
                ->latest()
                ->paginate(10)
        ]);
    }

    public function store(StoreUserEngagementRequest $request): RedirectResponse
    {
        auth()->user()->engagements()->create([
            ...$request->validated(),
            'engaged_at' => now()
        ]);

        return back()->with('success', 'Engagement recorded successfully');
    }

    public function update(StoreUserEngagementRequest $request, UserEngagement $engagement): RedirectResponse
    {
        $this->authorize('update', $engagement);
        
        $engagement->update($request->validated());
        
        return back()->with('success', 'Engagement updated successfully');
    }

    public function destroy(UserEngagement $engagement): RedirectResponse
    {
        $this->authorize('delete', $engagement);
        $engagement->delete();
        
        return back()->with('success', 'Engagement removed successfully');
    }
}

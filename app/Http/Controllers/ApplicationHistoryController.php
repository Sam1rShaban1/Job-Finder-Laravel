<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ApplicationHistory;
use App\Models\Application;
use Illuminate\Http\RedirectResponse;

class ApplicationHistoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Applications/History', [
            'applications' => auth()->user()->applications()
                ->with(['jobListing.employer', 'interview', 'history'])
                ->latest()
                ->get()
        ]);
    }

    public function store(Request $request, Application $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected,in_review',
            'remarks' => 'nullable|string|max:1000'
        ]);

        $history = ApplicationHistory::create([
            'application_id' => $application->id,
            'status' => $validated['status'],
            'remarks' => $validated['remarks'],
            'previous_status' => $application->status
        ]);

        $application->update(['status' => $validated['status']]);
        
        return back()->with('status', 'Application status updated successfully');
    }

    public function update(Request $request, ApplicationHistory $history)
    {
        $this->authorize('update', $history);
        
        $validated = $request->validate([
            'remarks' => 'nullable|string|max:1000'
        ]);
        
        $history->update($validated);
        
        return back()->with('status', 'History remarks updated');
    }

    public function destroy(ApplicationHistory $history)
    {
        $this->authorize('delete', $history);
        
        // Don't allow deleting the initial application status
        if ($history->previous_status === null) {
            return back()->with('error', 'Cannot delete initial application status');
        }
        
        // Revert application status to previous if this is the latest history
        $application = $history->application;
        if ($application->history()->latest()->first()->id === $history->id) {
            $application->update(['status' => $history->previous_status]);
        }
        
        $history->delete();
        return back()->with('status', 'History entry removed');
    }
}

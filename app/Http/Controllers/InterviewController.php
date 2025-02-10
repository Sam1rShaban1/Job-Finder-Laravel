<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterviewRequest;
use App\Models\Application;
use App\Models\Interview;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\Inertia;

class InterviewController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Interviews/Index', [
            'interviews' => auth()->user()->interviews()->with('application.jobListing')->latest()->get()
        ]);
    }

    public function schedule(InterviewRequest $request, Application $application): RedirectResponse
    {
        $interview = $application->interview()->create([
            'scheduled_at' => $request->scheduled_at,
            'interview_type' => $request->type,
            'location' => $request->location,
            'notes' => $request->notes
        ]);

        return redirect()->route('interviews.show', $interview)
            ->with('success', 'Interview scheduled successfully');
    }

    public function destroy(Interview $interview): RedirectResponse
    {
        $this->authorize('delete', $interview);
        $interview->delete();
        
        return back()->with('success', 'Interview canceled');
    }
}

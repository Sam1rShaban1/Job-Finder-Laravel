<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\StoreWorkExperienceRequest;
use App\Models\WorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkExperienceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(): Response
    {
        $experiences = WorkExperience::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Dashboard_Job_Finder/WorkExperienceDashboard/DashboardWorkExperience', [
            'experiences' => $experiences
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'description' => 'required|string'
        ]);

        $validated['user_id'] = Auth::id();
        WorkExperience::create($validated);

        if ($request->routeIs('work.experience.store')) {
            return redirect()->route('skills');
        }

        return redirect()->route('work-experiences.index');
    }

    public function update(Request $request, WorkExperience $experience): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'description' => 'required|string'
        ]);

        $experience->update($validated);
        return redirect()->route('work-experiences.index');
    }

    public function destroy(WorkExperience $experience): RedirectResponse
    {
        $experience->delete();
        return redirect()->route('work-experiences.index');
    }

    public function show(): Response
    {
        $experiences = WorkExperience::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('JobFinder_Register_Components/Work_Experience/WorkExperience', [
            'experiences' => $experiences
        ]);
    }
}
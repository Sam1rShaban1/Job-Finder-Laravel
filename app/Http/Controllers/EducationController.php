<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\StoreEducationRequest;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function index(): Response
    {
        $educations = Education::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Dashboard_Job_Finder/EducationDashboard/DashboardEducation', [
            'educations' => $educations
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('JobFinder_Register_Components/Education_Component/Education');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'coursework' => 'nullable|string'
        ]);

        $validated['user_id'] = Auth::id();
        Education::create($validated);

        if ($request->routeIs('education.store')) {
            return redirect()->route('certification');
        }

        return redirect()->route('dashboard.education');
    }

    public function edit(Education $education): Response
    {
        $this->authorize('update', $education);
        return Inertia::render('JobFinder_Register_Components/Education_Component/Education', [
            'education' => $education
        ]);
    }

    public function update(StoreEducationRequest $request, Education $education): RedirectResponse
    {
        $this->authorize('update', $education);
        $education->update($request->validated());
        
        return redirect()->route('dashboard.education')
            ->with('success', 'Education updated successfully');
    }

    public function destroy(Education $education): RedirectResponse
    {
        $this->authorize('delete', $education);
        $education->delete();
        
        return back()->with('success', 'Education record removed');
    }

    public function show(): Response
    {
        return Inertia::render('JobFinder_Register_Components/Education_Component/Education');
    }
}
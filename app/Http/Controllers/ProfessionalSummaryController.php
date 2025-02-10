<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfessionalSummaryController extends Controller
{
    public function show(): Response
    {
        return Inertia::render('JobFinder_Register_Components/Professional_Summary/Professional_Summary', [
            'summary' => Auth::user()->professional_summary
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'summary' => 'required|string'
        ]);

        User::where('id', Auth::id())->update([
            'professional_summary' => $validated['summary']
        ]);

        return redirect()->route('work.experience');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'summary' => 'required|string|max:1000'
        ]);

        User::where('id', Auth::id())->update([
            'professional_summary' => $validated['summary']
        ]);

        return back()->with('success', 'Professional summary updated successfully');
    }

    public function destroy(): RedirectResponse
    {
        User::where('id', Auth::id())->update([
            'professional_summary' => null
        ]);

        return back()->with('success', 'Professional summary removed');
    }

    public function dashboard()
    {
        return Inertia::render('Dashboard_Job_Finder/ProfessionalSummaryDashboard/DashboardProfessionalSummary', [
            'summary' => Auth::user()->professional_summary
        ]);
    }
} 
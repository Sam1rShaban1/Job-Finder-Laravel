<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Employers/Index', [
            'employers' => Employer::with('jobListings')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Employers/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employers',
            'phone_number' => 'required|string|max:20',
            'website_url' => 'nullable|url',
            'address' => 'required|string|max:255',
            'description' => 'required|string|max:1000'
        ]);

        auth()->user()->employer()->create($validated);
        
        return redirect()->route('employers.dashboard')
            ->with('success', 'Employer profile created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employer $employer): Response
    {
        return Inertia::render('Employers/Show', [
            'employer' => $employer->load(['jobListings', 'reviews'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employer $employer): Response
    {
        $this->authorize('update', $employer);
        return Inertia::render('Employers/Edit', ['employer' => $employer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employer $employer): RedirectResponse
    {
        $this->authorize('update', $employer);

        $validated = $request->validate([
            'company_name' => 'sometimes|string|max:255',
            'phone_number' => 'sometimes|string|max:20',
            'website_url' => 'nullable|url',
            'address' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:1000'
        ]);

        $employer->update($validated);
        
        return back()->with('success', 'Profile updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employer $employer): RedirectResponse
    {
        $this->authorize('delete', $employer);
        $employer->delete();
        return redirect()->route('home')->with('status', 'Employer profile deleted');
    }
}

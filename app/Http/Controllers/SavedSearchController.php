<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\StoreSavedSearchRequest;
use App\Models\SavedSearch;

class SavedSearchController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(): Response
    {
        return Inertia::render('Dashboard_Job_Finder/SavedSearchesDashboard/DashboardSavedSearches', [
            'searches' => auth()->user()->savedSearches()
                ->latest()
                ->paginate(10)
        ]);
    }

    public function store(StoreSavedSearchRequest $request): RedirectResponse
    {
        auth()->user()->savedSearches()->create([
            'name' => $request->validated()['name'],
            'search_criteria' => $request->validated()['criteria'],
            'frequency' => $request->validated()['frequency'] ?? null
        ]);

        return back()->with('success', 'Search saved successfully');
    }

    public function update(StoreSavedSearchRequest $request, SavedSearch $search): RedirectResponse
    {
        $this->authorize('update', $search);
        
        $search->update([
            'name' => $request->validated()['name'],
            'search_criteria' => $request->validated()['criteria'],
            'frequency' => $request->validated()['frequency']
        ]);

        return back()->with('success', 'Search updated');
    }

    public function destroy(SavedSearch $search): RedirectResponse
    {
        $this->authorize('delete', $search);
        $search->delete();
        
        return back()->with('success', 'Saved search removed');
    }
}

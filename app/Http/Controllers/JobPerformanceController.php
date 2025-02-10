<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\JobPerformance;
use App\Http\Requests\StoreJobPerformanceRequest;
use Illuminate\Http\RedirectResponse;

class JobPerformanceController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Dashboard/PerformanceMetrics', [
            'metrics' => auth()->user()->jobPerformances()
                ->with('jobListing')
                ->latest()
                ->paginate(10)
        ]);
    }

    public function store(StoreJobPerformanceRequest $request): RedirectResponse
    {
        auth()->user()->jobPerformances()->create(
            $request->validated()
        );

        return redirect()->route('performance.metrics')
            ->with('success', 'Performance metric recorded');
    }

    public function update(StoreJobPerformanceRequest $request, JobPerformance $performance): RedirectResponse
    {
        $this->authorize('update', $performance);
        
        $performance->update($request->validated());
        
        return back()->with('success', 'Metric updated');
    }

    public function destroy(JobPerformance $performance): RedirectResponse
    {
        $this->authorize('delete', $performance);
        $performance->delete();
        
        return back()->with('success', 'Metric removed');
    }
}

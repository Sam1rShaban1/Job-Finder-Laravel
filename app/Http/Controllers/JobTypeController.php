<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\JobType;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJobTypeRequest;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class JobTypeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/JobTypes/Index', [
            'types' => JobType::latest()->paginate(20)
        ]);
    }

    public function store(StoreJobTypeRequest $request): RedirectResponse
    {
        JobType::create($request->validated());
        return back()->with('success', 'Job type created successfully');
    }

    public function update(StoreJobTypeRequest $request, JobType $type): RedirectResponse
    {
        $this->authorize('update', $type);
        $type->update($request->validated());
        return back()->with('success', 'Job type updated');
    }

    public function destroy(JobType $type): RedirectResponse
    {
        $this->authorize('delete', $type);
        $type->delete();
        return back()->with('success', 'Job type removed');
    }
}

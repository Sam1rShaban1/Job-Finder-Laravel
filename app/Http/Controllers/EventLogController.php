<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\EventLog;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreEventLogRequest;

class EventLogController extends Controller
{
    public function index(): Response
    {
        $this->authorize('viewAny', EventLog::class);
        
        return Inertia::render('Admin/EventLogs/Index', [
            'logs' => EventLog::with('user')
                ->latest()
                ->paginate(20)
        ]);
    }

    public function store(StoreEventLogRequest $request): RedirectResponse
    {
        $this->authorize('create', EventLog::class);
        EventLog::create($request->validated());
        
        return back()->with('success', 'Event logged successfully');
    }

    public function update(StoreEventLogRequest $request, EventLog $eventLog): RedirectResponse
    {
        $this->authorize('update', $eventLog);
        $eventLog->update($request->validated());
        
        return back()->with('success', 'Event log updated');
    }

    public function destroy(EventLog $eventLog): RedirectResponse
    {
        $this->authorize('delete', $eventLog);
        $eventLog->delete();
        
        return back()->with('success', 'Event log removed');
    }
}

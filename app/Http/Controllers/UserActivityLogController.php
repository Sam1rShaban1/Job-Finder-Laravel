<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\StoreUserActivityLogRequest;
use App\Models\UserActivityLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserActivityLogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display the activity logs for the authenticated user.
     */
    public function index(): Response
    {
        try {
            $user = auth()->user();

            if (!$user) {
                return Inertia::render('Dashboard_Job_Finder/ActivityLogDashboard/DashboardActivityLogs', [
                    'logs' => [],
                    'error' => 'User not authenticated'
                ]);
            }

            return Inertia::render('Dashboard_Job_Finder/ActivityLogDashboard/DashboardActivityLogs', [
                'logs' => $user->activityLogs()
                    ->latest()
                    ->paginate(15)
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching activity logs: ' . $e->getMessage());
            return Inertia::render('Dashboard_Job_Finder/ActivityLogDashboard/DashboardActivityLogs', [
                'logs' => [],
                'error' => 'Unable to fetch activity logs'
            ]);
        }
    }

    /**
     * Store a new user activity log.
     */
    public function store(StoreUserActivityLogRequest $request): RedirectResponse
    {
        try {
            $user = auth()->user();

            if (!$user) {
                return back()->with('error', 'Unauthorized: User not authenticated.');
            }

            $log = $user->activityLogs()->create([
                ...$request->validated(),
                'ip_address' => $request->ip(),
                'logged_at' => now()
            ]);

            Log::info("Activity logged successfully for User ID: {$user->id}", ['log_id' => $log->id]);

            return back()->with('success', 'Activity logged successfully.');
        } catch (\Exception $e) {
            Log::error('Error storing activity log: ' . $e->getMessage());
            return back()->with('error', 'Failed to log activity.');
        }
    }

    /**
     * Update an existing activity log.
     */
    public function update(StoreUserActivityLogRequest $request, UserActivityLog $log): RedirectResponse
    {
        try {
            $this->authorize('update', $log);
            $log->update($request->validated());

            Log::info("Activity log updated successfully for Log ID: {$log->id}");

            return back()->with('success', 'Activity log updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating activity log: ' . $e->getMessage());
            return back()->with('error', 'Failed to update activity log.');
        }
    }

    /**
     * Delete an activity log.
     */
    public function destroy(UserActivityLog $log): RedirectResponse
    {
        try {
            $this->authorize('delete', $log);
            $log->delete();

            Log::info("Activity log deleted successfully for Log ID: {$log->id}");

            return back()->with('success', 'Activity log removed successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting activity log: ' . $e->getMessage());
            return back()->with('error', 'Failed to remove activity log.');
        }
    }
}
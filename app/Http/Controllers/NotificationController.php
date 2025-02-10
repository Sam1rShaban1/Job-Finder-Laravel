<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Middleware\ProfileCompleteness;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', ProfileCompleteness::class]);
    }

    public function index(Request $request): Response
    {
        return Inertia::render('Notifications/Index', [
            'notifications' => auth()->user()->notifications()
                ->when($request->has('type'), function($query) use ($request) {
                    return $query->where('type', $request->type);
                })
                ->latest()
                ->paginate(10),
            'notificationTypes' => Notification::distinct()->pluck('type')
        ]);
    }

    public function markAsRead(Request $request, Notification $notification): RedirectResponse
    {
        abort_unless($request->user()->id === $notification->notifiable_id, 403);
        
        $notification->markAsRead();

        return back()->with('success', 'Notification marked as read');
    }

    public function markAllAsRead(): RedirectResponse
    {
        auth()->user()->unreadNotifications()->update(['is_read' => true]);

        return redirect()->route('notifications.index')
            ->with('success', 'All notifications marked as read');
    }

    public function destroy(Notification $notification): RedirectResponse
    {
        abort_unless(auth()->id() === $notification->notifiable_id, 403);
        
        $notification->delete();
        
        return back()->with('success', 'Notification deleted');
    }
}

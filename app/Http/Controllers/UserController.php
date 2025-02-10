<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except(['show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $this->authorize('viewAny', User::class);
        
        return Inertia::render('Admin/Users/Index', [
            'users' => User::with(['employer', 'applications'])
                ->latest()
                ->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);
        
        return Inertia::render('Admin/Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,employer,user'
        ]);

        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): Response
    {
        $this->authorize('view', $user);

        return Inertia::render('Admin/Users/Show', [
            'profileUser' => $user->load(['employer', 'applications.jobListing'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return Inertia::render('Admin/Users/Edit', [
            'editUser' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'sometimes|in:admin,employer,user'
        ]);

        $user->update($validated);

        if ($user->wasChanged('email')) {
            $user->forceFill(['email_verified_at' => null])->save();
        }

        return back()->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete', $user);
        
        $user->delete();
        
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.auth()->id(),
            'phone' => 'nullable|string|max:20',
            'professional_summary' => 'nullable|string|max:1000'
        ]);

        auth()->user()->update($validated);
        
        return back()->with('success', 'Profile updated successfully');
    }

    public function updatePreferences(Request $request)
    {
        $validated = $request->validate([
            'notification_email' => 'required|email',
            'job_alerts' => 'required|boolean',
            'privacy_settings' => 'required|array'
        ]);

        auth()->user()->preferences()->updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );
        
        return back()->with('status', 'Preferences updated');
    }

    public function deactivate(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password']
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        
        return redirect()->route('home')->with('status', 'Account deactivated');
    }
}

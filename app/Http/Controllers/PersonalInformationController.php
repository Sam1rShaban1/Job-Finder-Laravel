<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class PersonalInformationController extends Controller
{
    public function show()
    {
        return Inertia::render('JobFinder_Register_Components/Register_File/PersonalInformation');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'address' => 'required|string|max:255',
            'role' => 'required|string|in:employer,job-seeker'
        ]);

        $user = User::create([
            'name' => $validated['fullname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'address' => $validated['address'],
            'role' => $validated['role']
        ]);

        Auth::login($user);

        if ($validated['role'] === 'employer') {
            return redirect()->route('company.info');
        }

        // For job-seeker, redirect to professional summary
        return redirect()->route('professional.summary');
    }

    public function index()
    {
        return Inertia::render('Dashboard_Job_Finder/PersonalInfoDashboard/DashboardPersonalInformation', [
            'user' => Auth::user() ? Auth::user()->only(['id', 'name', 'email', 'address']) : []
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'address' => 'required|string'
        ]);

        $user = User::find(Auth::id());
        if ($user) {
            $user->name = $validated['fullName'];
            $user->email = $validated['email'];
            $user->address = $validated['address'];
            $user->save();
        }

        return back()->with('success', 'Personal information updated successfully');
    }
}
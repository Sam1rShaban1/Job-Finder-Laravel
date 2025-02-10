<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function personalInformation()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to access this page.');
        }

        // Retrieve the authenticated user's information
        $user = Auth::user();

        // Pass the user information to the view
        return view('dashboard.personal_information', compact('user')); // Adjust as necessary
    }
} 
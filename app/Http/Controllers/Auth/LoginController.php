<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/personal-information';

    /**
     * Show the login form.
     *
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            // Redirect authenticated users directly to personal information
            return redirect()->route('dashboard.personal.information');
        }

        return Inertia::render('Auth/Login');
    }

    /**
     * Handle redirection after successful login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        // Explicitly set the redirection route
        return '/dashboard/personal-information';
    }
}
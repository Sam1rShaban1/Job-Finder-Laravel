<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProfileCompleteness
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->profile_complete && 
            !$request->is('profile/*') &&
            !$request->is('dashboard')) {
            return redirect()->route('profile.completion');
        }

        return $next($request);
    }
} 
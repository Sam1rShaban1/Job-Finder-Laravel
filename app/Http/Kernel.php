<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Middleware;
use App\Http\Middleware\EnsureEmployerUser;
use App\Http\Middleware\EnsureJobFinderUser;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'employer' => EnsureEmployerUser::class,
        'user' => EnsureJobFinderUser::class,
    ];
} 
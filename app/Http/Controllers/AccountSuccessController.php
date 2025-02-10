<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class AccountSuccessController extends Controller
{
    public function show()
    {
        return Inertia::render('JobFinder_Register_Components/Succesfully_Created/AccountSuccess');
    }
} 
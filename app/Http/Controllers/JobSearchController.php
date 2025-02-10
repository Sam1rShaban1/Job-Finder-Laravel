<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobSearchRequest;
use App\Models\JobListing;
use Inertia\Inertia;
use Illuminate\Http\Request;

class JobSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = JobListing::with('employer')
            ->when($request->search, fn($q) => $q->where('title', 'LIKE', "%{$request->search}%"))
            ->when($request->location, fn($q) => $q->whereHas('employer', fn($q) => 
                $q->where('address', 'LIKE', "%{$request->location}%")))
            ->when($request->type, fn($q) => $q->where('type', $request->type));

        return Inertia::render('Jobs/Index', [
            'jobs' => $query->latest()->paginate(10)
        ]);
    }
} 
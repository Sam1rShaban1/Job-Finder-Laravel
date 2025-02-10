<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class CompanyInfoController extends Controller
{
    public function index()
    {
        return Inertia::render('Employer_Register_Components/CompanyInfo_Component/CompanyInfo');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'companyname' => 'required|string|max:255',
            'companyoverview' => 'required|string',
            'companyculture' => 'required|string',
            'companywebsite' => 'required|url',
            'address' => 'required|string',
            'companylogo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $logoPath = $request->file('companylogo')->store('company-logos', 'public');

        Employer::create([
            'company_name' => $validated['companyname'],
            'description' => $validated['companyoverview'],
            'culture' => $validated['companyculture'],
            'website_url' => $validated['companywebsite'],
            'address' => $validated['address'],
            'logo' => $logoPath,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('dashboard')->with('success', 'Company information saved successfully');
    }
} 
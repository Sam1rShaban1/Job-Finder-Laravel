<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreCertificationRequest;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificationController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('JobFinder_Register_Components/Certification_Component/Certification', [
            'certifications' => Certification::where('user_id', Auth::id())->latest()->get()
        ]);
    }
    
    public function store(Request $request) 
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'issuedBy' => 'required|string|max:255',
            'startDate' => 'required|date',
            'endDate' => 'nullable|date',
            'credential_id' => 'required|string|max:255',
        ]);

        Certification::create([
            'name' => $validated['name'],
            'issued_by' => $validated['issuedBy'],
            'start_date' => $validated['startDate'],
            'end_date' => $validated['endDate'],
            'credential_id' => $validated['credential_id'],
            'user_id' => Auth::id()
        ]);

        return to_route('account.success');
    }

    public function update(StoreCertificationRequest $request, Certification $certification): RedirectResponse
    {
        $this->authorize('update', $certification);
        $certification->update($request->validated());
        
        return back()->with('success', 'Certification updated successfully');
    }

    public function destroy(Certification $certification): RedirectResponse
    {
        $this->authorize('delete', $certification);
        $certification->delete();
        
        return back()->with('success', 'Certification removed');
    }

    public function show(): Response
    {
        return Inertia::render('JobFinder_Register_Components/Certification_Component/Certification');
    }
} 
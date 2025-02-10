<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PreferenceController extends Controller
{
    public function show(): JsonResponse
    {
        $preference = Preference::where('user_id', auth()->id())->first();

        return response()->json([
            'status' => 'success',
            'preference' => $preference
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'settings' => 'required|json'
        ]);

        $preference = Preference::firstOrCreate(
            ['user_id' => auth()->id()],
            ['settings' => $validated['settings']]
        );

        return response()->json([
            'status' => 'success',
            'preference' => $preference
        ], 200);
    }

    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'settings' => 'required|json'
        ]);

        $preference = Preference::where('user_id', auth()->id())->firstOrFail();
        $mergedSettings = array_merge(
            json_decode($preference->settings, true) ?? [],
            json_decode($validated['settings'], true)
        );
        
        $preference->update(['settings' => json_encode($mergedSettings)]);

        return response()->json([
            'status' => 'success',
            'preference' => $preference
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use App\Models\Skill;

class SkillController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the skill input form.
     */
    public function show(): Response
    {
        return Inertia::render('JobFinder_Register_Components/Skills_Component/Skills');
    }

    /**
     * Display the user's skills.
     */
    public function index(): Response
    {
        $user = Auth::user();

        return Inertia::render('Dashboard_Job_Finder/SkillsDashboard/DashboardSkills', [
            'userSkills' => $user->skills()->get(),
            'proficiencyLevels' => Skill::PROFICIENCY_LEVELS
        ]);
    }

    /**
     * Store user skills and redirect to the education page.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'skills' => 'required|array|min:1',
            'skills.*.name' => 'required|string|max:255',
            'skills.*.proficiency' => 'required|string|in:' . implode(',', Skill::PROFICIENCY_LEVELS),
        ]);

        $user = Auth::user();

        if (!$user) {
            return back()->with('error', 'User not authenticated.');
        }

        // Get existing skills (case insensitive)
        $existingSkills = $user->skills()->pluck('name')->map(fn($name) => strtolower($name))->toArray();

        $newSkills = [];

        foreach ($validated['skills'] as $skill) {
            if (!in_array(strtolower($skill['name']), $existingSkills)) { 
                $newSkills[] = $skill;
            }
        }

        if (!empty($newSkills)) {
            $user->skills()->createMany($newSkills);
            Log::info("User ID {$user->id} added new skills", ['skills' => $newSkills]);
        }

        return redirect()->route('education')->with([
            'success' => !empty($newSkills) ? 'Skills added successfully!' : 'No new skills added (duplicates removed).',
            'skills' => $user->skills()->get()
        ]);
    }

    /**
     * Update a skill.
     */
    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'proficiency' => 'required|string|in:' . implode(',', Skill::PROFICIENCY_LEVELS),
        ]);

        $this->authorize('update', $skill);
        
        $skill->update($validated);

        return back()->with([
            'success' => 'Skill updated successfully',
            'skill' => $skill
        ]);
    }

    /**
     * Delete a skill.
     */
    public function destroy(Skill $skill): RedirectResponse
    {
        $this->authorize('delete', $skill);
        
        $skill->delete();

        return back()->with('success', 'Skill deleted successfully');
    }
}
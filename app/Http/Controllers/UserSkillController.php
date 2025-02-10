<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\StoreUserSkillRequest;
use App\Models\UserSkill;
use Illuminate\Support\Facades\Auth;

class UserSkillController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display user skills.
     */
    public function index(): Response
    {
        return Inertia::render('Dashboard_Job_Finder/UserSkillsDashboard/DashboardUserSkills', [
            'userSkills' => Auth::user()->userSkills()->with('skill')->latest()->paginate(10)
        ]);
    }

    /**
     * Store a newly created skill in the database.
     */
    public function store(StoreUserSkillRequest $request): JsonResponse
    {
        try {
            $skill = Auth::user()->userSkills()->create($request->validated());

            return response()->json([
                'message' => 'Skill proficiency recorded successfully',
                'skill' => $skill
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error saving skill',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update an existing skill.
     */
    public function update(StoreUserSkillRequest $request, UserSkill $userSkill): JsonResponse
    {
        $this->authorize('update', $userSkill);

        try {
            $userSkill->update($request->validated());

            return response()->json([
                'message' => 'Skill proficiency updated successfully',
                'skill' => $userSkill
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating skill',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove a skill from the database.
     */
    public function destroy(UserSkill $userSkill): JsonResponse
    {
        $this->authorize('delete', $userSkill);

        try {
            $userSkill->delete();

            return response()->json([
                'message' => 'Skill proficiency removed successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting skill',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
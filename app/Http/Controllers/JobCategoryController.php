<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJobCategoryRequest;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class JobCategoryController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/JobCategories/Index', [
            'categories' => JobCategory::latest()->paginate(20)
        ]);
    }

    public function store(StoreJobCategoryRequest $request): RedirectResponse
    {
        JobCategory::create($request->validated());
        return back()->with('success', 'Category created successfully');
    }

    public function update(StoreJobCategoryRequest $request, JobCategory $category): RedirectResponse
    {
        $this->authorize('update', $category);
        $category->update($request->validated());
        return back()->with('success', 'Category updated');
    }

    public function destroy(JobCategory $category): RedirectResponse
    {
        $this->authorize('delete', $category);
        $category->delete();
        return back()->with('success', 'Category removed');
    }
}

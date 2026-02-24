<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $businessId = $request->input('business_id');
        $projects = Project::forBusiness($businessId)->latest()->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function create(Request $request)
    {
        $businessId = $request->input('business_id');
        return view('projects.create', compact('businessId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'project_name' => 'required|string|max:255',
            'estimated_cost' => 'required|numeric|min:0',
            'actual_cost' => 'nullable|numeric|min:0',
            'status' => 'required|in:planning,active,completed,cancelled',
        ]);

        $validated['business_id'] = $request->input('business_id');
        
        Project::create($validated);
        
        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function show(Request $request, Project $project)
    {
        // Ensure project belongs to current business
        if ($project->business_id != $request->input('business_id')) {
            abort(403);
        }
        
        return view('projects.show', compact('project'));
    }

    public function edit(Request $request, Project $project)
    {
        // Ensure project belongs to current business
        if ($project->business_id != $request->input('business_id')) {
            abort(403);
        }
        
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        // Ensure project belongs to current business
        if ($project->business_id != $request->input('business_id')) {
            abort(403);
        }

        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'project_name' => 'required|string|max:255',
            'estimated_cost' => 'required|numeric|min:0',
            'actual_cost' => 'nullable|numeric|min:0',
            'status' => 'required|in:planning,active,completed,cancelled',
        ]);

        $project->update($validated);
        
        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Request $request, Project $project)
    {
        // Ensure project belongs to current business
        if ($project->business_id != $request->input('business_id')) {
            abort(403);
        }

        $project->delete();
        
        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}

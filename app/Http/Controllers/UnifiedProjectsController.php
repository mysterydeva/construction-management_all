<?php

namespace App\Http\Controllers;

use App\Data\DemoDataProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UnifiedProjectsController extends Controller
{
    /**
     * Display a listing of projects.
     */
    public function index(Request $request)
    {
        try {
            Log::info('Entered UnifiedProjectsController@index');
            
            $businessType = session('business_type', 'construction');
            Log::info('Business type: ' . $businessType);
            
            if ($businessType === 'sales') {
                // Sales mode - show message to use leads
                Log::info('Sales mode - showing leads message');
                return view('projects.unified', compact('businessType'));
            }
            
            // Get projects based on business type
            $projects = match($businessType) {
                'construction' => DemoDataProvider::getConstructionProjects() ?? [],
                'design' => DemoDataProvider::getDesignProjects() ?? [],
                default => DemoDataProvider::getConstructionProjects() ?? [],
            };
            
            Log::info('Projects loaded: ' . count($projects));
            
            return view('projects.unified', compact('projects', 'businessType'));
            
        } catch (\Exception $e) {
            Log::error('UnifiedProjectsController@index error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // Return error view with fallback data
            return view('projects.unified', [
                'projects' => [],
                'businessType' => 'construction'
            ]);
        }
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        try {
            Log::info('Entered UnifiedProjectsController@create');
            return view('projects.create');
        } catch (\Exception $e) {
            Log::error('UnifiedProjectsController@create error: ' . $e->getMessage());
            return redirect()->route('projects.index')->with('error', 'Unable to load create form');
        }
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Entered UnifiedProjectsController@store');
            
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'client' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'budget' => 'required|numeric|min:0',
            ]);

            // Simulate save using session flash message
            Log::info('Project created successfully: ' . $validated['name']);
            session()->flash('success', 'Project created successfully!');
            
            return redirect()->route('projects.index');
            
        } catch (\Exception $e) {
            Log::error('UnifiedProjectsController@store error: ' . $e->getMessage());
            session()->flash('error', 'Failed to create project');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit($id)
    {
        try {
            Log::info('Entered UnifiedProjectsController@edit with id: ' . $id);
            
            $businessType = session('business_type', 'construction');
            
            // Simulate getting project data
            $projects = match($businessType) {
                'construction' => DemoDataProvider::getConstructionProjects() ?? [],
                'design' => DemoDataProvider::getDesignProjects() ?? [],
                default => DemoDataProvider::getConstructionProjects() ?? [],
            };
            
            $project = collect($projects)->firstWhere('id', $id);
            
            if (!$project) {
                Log::warning('Project not found with id: ' . $id);
                session()->flash('error', 'Project not found!');
                return redirect()->route('projects.index');
            }
            
            Log::info('Project found: ' . ($project['name'] ?? 'Unknown'));
            
            return view('projects.edit', compact('project'));
            
        } catch (\Exception $e) {
            Log::error('UnifiedProjectsController@edit error: ' . $e->getMessage());
            session()->flash('error', 'Unable to load project for editing');
            return redirect()->route('projects.index');
        }
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            Log::info('Entered UnifiedProjectsController@update with id: ' . $id);
            
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'client' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'budget' => 'required|numeric|min:0',
            ]);

            // Simulate update using session flash message
            Log::info('Project updated successfully: ' . $validated['name']);
            session()->flash('success', 'Project updated successfully!');
            
            return redirect()->route('projects.index');
            
        } catch (\Exception $e) {
            Log::error('UnifiedProjectsController@update error: ' . $e->getMessage());
            session()->flash('error', 'Failed to update project');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy($id)
    {
        try {
            Log::info('Entered UnifiedProjectsController@destroy with id: ' . $id);
            
            // Simulate delete using session flash message
            Log::info('Project deleted successfully with id: ' . $id);
            session()->flash('success', 'Project deleted successfully!');
            
            return redirect()->route('projects.index');
            
        } catch (\Exception $e) {
            Log::error('UnifiedProjectsController@destroy error: ' . $e->getMessage());
            session()->flash('error', 'Failed to delete project');
            return redirect()->route('projects.index');
        }
    }
}

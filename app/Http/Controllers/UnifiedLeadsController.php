<?php

namespace App\Http\Controllers;

use App\Data\DemoDataProvider;
use Illuminate\Http\Request;

class UnifiedLeadsController extends Controller
{
    /**
     * Display a listing of leads.
     */
    public function index(Request $request)
    {
        $businessType = session('business_type', 'construction');
        
        if ($businessType !== 'sales') {
            // Only sales has leads
            return view('leads.unified', compact('businessType'));
        }
        
        $leads = DemoDataProvider::getSalesLeads();
        
        return view('leads.unified', compact('leads', 'businessType'));
    }

    /**
     * Show the form for creating a new lead.
     */
    public function create()
    {
        return view('leads.create');
    }

    /**
     * Store a newly created lead in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'required|string|max:255',
            'source' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'budget' => 'required|numeric|min:0',
        ]);

        // Simulate save using session flash message
        session()->flash('success', 'Lead created successfully!');
        
        return redirect()->route('leads.index');
    }

    /**
     * Show the form for editing the specified lead.
     */
    public function edit($id)
    {
        $leads = DemoDataProvider::getSalesLeads();
        $lead = collect($leads)->firstWhere('id', $id);
        
        if (!$lead) {
            session()->flash('error', 'Lead not found!');
            return redirect()->route('leads.index');
        }
        
        return view('leads.edit', compact('lead'));
    }

    /**
     * Update the specified lead in storage.
     */
    public function update(Request $request, $id)
    {
        // Simulate update using session flash message
        session()->flash('success', 'Lead updated successfully!');
        
        return redirect()->route('leads.index');
    }

    /**
     * Remove the specified lead from storage.
     */
    public function destroy($id)
    {
        // Simulate delete using session flash message
        session()->flash('success', 'Lead deleted successfully!');
        
        return redirect()->route('leads.index');
    }
}

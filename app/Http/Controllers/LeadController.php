<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $businessId = $request->input('business_id');
        $leads = Lead::forBusiness($businessId)->latest()->paginate(10);
        return view('leads.index', compact('leads'));
    }

    public function create(Request $request)
    {
        $businessId = $request->input('business_id');
        return view('leads.create', compact('businessId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'source' => 'required|string|max:50',
            'status' => 'required|in:new,contacted,qualified,converted,lost',
        ]);

        $validated['business_id'] = $request->input('business_id');
        
        Lead::create($validated);
        
        return redirect()->route('leads.index')
            ->with('success', 'Lead created successfully.');
    }

    public function show(Request $request, Lead $lead)
    {
        if ($lead->business_id != $request->input('business_id')) {
            abort(403);
        }
        
        return view('leads.show', compact('lead'));
    }

    public function edit(Request $request, Lead $lead)
    {
        if ($lead->business_id != $request->input('business_id')) {
            abort(403);
        }
        
        return view('leads.edit', compact('lead'));
    }

    public function update(Request $request, Lead $lead)
    {
        if ($lead->business_id != $request->input('business_id')) {
            abort(403);
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'source' => 'required|string|max:50',
            'status' => 'required|in:new,contacted,qualified,converted,lost',
        ]);

        $lead->update($validated);
        
        return redirect()->route('leads.index')
            ->with('success', 'Lead updated successfully.');
    }

    public function destroy(Request $request, Lead $lead)
    {
        if ($lead->business_id != $request->input('business_id')) {
            abort(403);
        }

        $lead->delete();
        
        return redirect()->route('leads.index')
            ->with('success', 'Lead deleted successfully.');
    }
}

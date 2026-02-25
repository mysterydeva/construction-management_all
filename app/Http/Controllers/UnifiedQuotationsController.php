<?php

namespace App\Http\Controllers;

use App\Data\DemoDataProvider;
use Illuminate\Http\Request;

class UnifiedQuotationsController extends Controller
{
    /**
     * Display a listing of quotations.
     */
    public function index(Request $request)
    {
        $businessType = session('business_type', 'construction');
        
        if ($businessType !== 'sales') {
            // Only sales has quotations
            return view('quotations.unified', compact('businessType'));
        }
        
        $quotations = DemoDataProvider::getSalesQuotations();
        
        return view('quotations.unified', compact('quotations', 'businessType'));
    }

    /**
     * Show the form for creating a new quotation.
     */
    public function create()
    {
        return view('quotations.create');
    }

    /**
     * Store a newly created quotation in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'quote_number' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'project_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'gst' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);

        // Simulate save using session flash message
        session()->flash('success', 'Quotation created successfully!');
        
        return redirect()->route('quotations.index');
    }

    /**
     * Show the form for editing the specified quotation.
     */
    public function edit($id)
    {
        $quotations = DemoDataProvider::getSalesQuotations();
        $quotation = collect($quotations)->firstWhere('id', $id);
        
        if (!$quotation) {
            session()->flash('error', 'Quotation not found!');
            return redirect()->route('quotations.index');
        }
        
        return view('quotations.edit', compact('quotation'));
    }

    /**
     * Update the specified quotation in storage.
     */
    public function update(Request $request, $id)
    {
        // Simulate update using session flash message
        session()->flash('success', 'Quotation updated successfully!');
        
        return redirect()->route('quotations.index');
    }

    /**
     * Remove the specified quotation from storage.
     */
    public function destroy($id)
    {
        // Simulate delete using session flash message
        session()->flash('success', 'Quotation deleted successfully!');
        
        return redirect()->route('quotations.index');
    }
}

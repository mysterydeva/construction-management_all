<?php

namespace App\Http\Controllers;

use App\Data\DemoDataProvider;
use Illuminate\Http\Request;

class UnifiedInvoicesController extends Controller
{
    /**
     * Display a listing of invoices.
     */
    public function index(Request $request)
    {
        $businessType = session('business_type', 'construction');
        
        // Get invoices based on business type
        $invoices = match($businessType) {
            'construction' => DemoDataProvider::getConstructionInvoices(),
            'sales' => DemoDataProvider::getSalesInvoices(),
            'design' => DemoDataProvider::getDesignInvoices(),
            default => DemoDataProvider::getConstructionInvoices(),
        };
        
        return view('invoices.unified', compact('invoices', 'businessType'));
    }

    /**
     * Show the form for creating a new invoice.
     */
    public function create()
    {
        return view('invoices.create');
    }

    /**
     * Store a newly created invoice in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|max:255',
            'client' => 'required|string|max:255',
            'project' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'gst' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);

        // Simulate save using session flash message
        session()->flash('success', 'Invoice created successfully!');
        
        return redirect()->route('invoices.index');
    }

    /**
     * Show the form for editing the specified invoice.
     */
    public function edit($id)
    {
        $businessType = session('business_type', 'construction');
        
        $invoices = match($businessType) {
            'construction' => DemoDataProvider::getConstructionInvoices(),
            'sales' => DemoDataProvider::getSalesInvoices(),
            'design' => DemoDataProvider::getDesignInvoices(),
            default => DemoDataProvider::getConstructionInvoices(),
        };
        
        $invoice = collect($invoices)->firstWhere('id', $id);
        
        if (!$invoice) {
            session()->flash('error', 'Invoice not found!');
            return redirect()->route('invoices.index');
        }
        
        return view('invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified invoice in storage.
     */
    public function update(Request $request, $id)
    {
        // Simulate update using session flash message
        session()->flash('success', 'Invoice updated successfully!');
        
        return redirect()->route('invoices.index');
    }

    /**
     * Remove the specified invoice from storage.
     */
    public function destroy($id)
    {
        // Simulate delete using session flash message
        session()->flash('success', 'Invoice deleted successfully!');
        
        return redirect()->route('invoices.index');
    }
}

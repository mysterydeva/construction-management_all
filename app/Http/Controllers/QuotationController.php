<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function index(Request $request)
    {
        $businessId = $request->input('business_id');
        $quotations = Quotation::forBusiness($businessId)->latest()->paginate(10);
        return view('quotations.index', compact('quotations'));
    }

    public function create(Request $request)
    {
        $businessId = $request->input('business_id');
        return view('quotations.create', compact('businessId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:draft,sent,accepted,rejected',
        ]);

        $validated['business_id'] = $request->input('business_id');
        
        Quotation::create($validated);
        
        return redirect()->route('quotations.index')
            ->with('success', 'Quotation created successfully.');
    }

    public function show(Request $request, Quotation $quotation)
    {
        if ($quotation->business_id != $request->input('business_id')) {
            abort(403);
        }
        
        return view('quotations.show', compact('quotation'));
    }

    public function edit(Request $request, Quotation $quotation)
    {
        if ($quotation->business_id != $request->input('business_id')) {
            abort(403);
        }
        
        return view('quotations.edit', compact('quotation'));
    }

    public function update(Request $request, Quotation $quotation)
    {
        if ($quotation->business_id != $request->input('business_id')) {
            abort(403);
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:draft,sent,accepted,rejected',
        ]);

        $quotation->update($validated);
        
        return redirect()->route('quotations.index')
            ->with('success', 'Quotation updated successfully.');
    }

    public function destroy(Request $request, Quotation $quotation)
    {
        if ($quotation->business_id != $request->input('business_id')) {
            abort(403);
        }

        $quotation->delete();
        
        return redirect()->route('quotations.index')
            ->with('success', 'Quotation deleted successfully.');
    }
}

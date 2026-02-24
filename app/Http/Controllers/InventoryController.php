<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $businessId = $request->input('business_id');
        $items = Inventory::forBusiness($businessId)->latest()->paginate(10);
        return view('inventory.index', compact('items'));
    }

    public function create(Request $request)
    {
        $businessId = $request->input('business_id');
        return view('inventory.create', compact('businessId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $validated['business_id'] = $request->input('business_id');
        
        Inventory::create($validated);
        
        return redirect()->route('inventory.index')
            ->with('success', 'Inventory item created successfully.');
    }

    public function show(Request $request, Inventory $inventory)
    {
        if ($inventory->business_id != $request->input('business_id')) {
            abort(403);
        }
        
        return view('inventory.show', compact('inventory'));
    }

    public function edit(Request $request, Inventory $inventory)
    {
        if ($inventory->business_id != $request->input('business_id')) {
            abort(403);
        }
        
        return view('inventory.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        if ($inventory->business_id != $request->input('business_id')) {
            abort(403);
        }

        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $inventory->update($validated);
        
        return redirect()->route('inventory.index')
            ->with('success', 'Inventory item updated successfully.');
    }

    public function destroy(Request $request, Inventory $inventory)
    {
        if ($inventory->business_id != $request->input('business_id')) {
            abort(403);
        }

        $inventory->delete();
        
        return redirect()->route('inventory.index')
            ->with('success', 'Inventory item deleted successfully.');
    }
}

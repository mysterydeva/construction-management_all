<?php

namespace App\Http\Controllers;

use App\Data\DemoDataProvider;
use Illuminate\Http\Request;

class UnifiedInventoryController extends Controller
{
    /**
     * Display a listing of inventory items.
     */
    public function index(Request $request)
    {
        $businessType = session('business_type', 'construction');
        
        if ($businessType !== 'construction') {
            // Only construction has inventory
            return view('inventory.unified', compact('businessType'));
        }
        
        $inventory = DemoDataProvider::getConstructionInventory();
        
        return view('inventory.unified', compact('inventory', 'businessType'));
    }

    /**
     * Show the form for creating a new inventory item.
     */
    public function create()
    {
        return view('inventory.create');
    }

    /**
     * Store a newly created inventory item in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);

        // Simulate save using session flash message
        session()->flash('success', 'Inventory item added successfully!');
        
        return redirect()->route('inventory.index');
    }

    /**
     * Show the form for editing the specified inventory item.
     */
    public function edit($id)
    {
        $inventory = DemoDataProvider::getConstructionInventory();
        $item = collect($inventory)->firstWhere('id', $id);
        
        if (!$item) {
            session()->flash('error', 'Inventory item not found!');
            return redirect()->route('inventory.index');
        }
        
        return view('inventory.edit', compact('item'));
    }

    /**
     * Update the specified inventory item in storage.
     */
    public function update(Request $request, $id)
    {
        // Simulate update using session flash message
        session()->flash('success', 'Inventory item updated successfully!');
        
        return redirect()->route('inventory.index');
    }

    /**
     * Remove the specified inventory item from storage.
     */
    public function destroy($id)
    {
        // Simulate delete using session flash message
        session()->flash('success', 'Inventory item deleted successfully!');
        
        return redirect()->route('inventory.index');
    }
}

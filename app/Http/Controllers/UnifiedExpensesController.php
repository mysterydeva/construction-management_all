<?php

namespace App\Http\Controllers;

use App\Data\DemoDataProvider;
use Illuminate\Http\Request;

class UnifiedExpensesController extends Controller
{
    /**
     * Display a listing of expenses.
     */
    public function index(Request $request)
    {
        $businessType = session('business_type', 'construction');
        
        // Get expenses based on business type
        $expenses = match($businessType) {
            'construction' => DemoDataProvider::getConstructionExpenses(),
            'design' => DemoDataProvider::getDesignExpenses(),
            default => DemoDataProvider::getConstructionExpenses(),
        };
        
        return view('expenses.unified', compact('expenses', 'businessType'));
    }

    /**
     * Show the form for creating a new expense.
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created expense in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'description' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
        ]);

        // Simulate save using session flash message
        session()->flash('success', 'Expense recorded successfully!');
        
        return redirect()->route('expenses.index');
    }

    /**
     * Show the form for editing the specified expense.
     */
    public function edit($id)
    {
        $businessType = session('business_type', 'construction');
        
        $expenses = match($businessType) {
            'construction' => DemoDataProvider::getConstructionExpenses(),
            'design' => DemoDataProvider::getDesignExpenses(),
            default => DemoDataProvider::getConstructionExpenses(),
        };
        
        $expense = collect($expenses)->firstWhere('id', $id);
        
        if (!$expense) {
            session()->flash('error', 'Expense not found!');
            return redirect()->route('expenses.index');
        }
        
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified expense in storage.
     */
    public function update(Request $request, $id)
    {
        // Simulate update using session flash message
        session()->flash('success', 'Expense updated successfully!');
        
        return redirect()->route('expenses.index');
    }

    /**
     * Remove the specified expense from storage.
     */
    public function destroy($id)
    {
        // Simulate delete using session flash message
        session()->flash('success', 'Expense deleted successfully!');
        
        return redirect()->route('expenses.index');
    }
}

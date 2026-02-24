<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $businessId = $request->input('business_id');
        $expenses = Expense::forBusiness($businessId)->latest()->paginate(10);
        return view('expenses.index', compact('expenses'));
    }

    public function create(Request $request)
    {
        $businessId = $request->input('business_id');
        return view('expenses.create', compact('businessId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:50',
        ]);

        $validated['business_id'] = $request->input('business_id');
        
        Expense::create($validated);
        
        return redirect()->route('expenses.index')
            ->with('success', 'Expense created successfully.');
    }

    public function show(Request $request, Expense $expense)
    {
        if ($expense->business_id != $request->input('business_id')) {
            abort(403);
        }
        
        return view('expenses.show', compact('expense'));
    }

    public function edit(Request $request, Expense $expense)
    {
        if ($expense->business_id != $request->input('business_id')) {
            abort(403);
        }
        
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        if ($expense->business_id != $request->input('business_id')) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:50',
        ]);

        $expense->update($validated);
        
        return redirect()->route('expenses.index')
            ->with('success', 'Expense updated successfully.');
    }

    public function destroy(Request $request, Expense $expense)
    {
        if ($expense->business_id != $request->input('business_id')) {
            abort(403);
        }

        $expense->delete();
        
        return redirect()->route('expenses.index')
            ->with('success', 'Expense deleted successfully.');
    }
}

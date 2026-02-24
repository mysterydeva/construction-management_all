<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $businessId = $request->input('business_id');
        $invoices = Invoice::forBusiness($businessId)->latest()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    public function create(Request $request)
    {
        $businessId = $request->input('business_id');
        // Generate next invoice number
        $lastInvoice = Invoice::forBusiness($businessId)->latest()->first();
        $nextNumber = $lastInvoice ? ((int)str_replace('INV-', '', $lastInvoice->invoice_number) + 1) : 1;
        $invoiceNumber = 'INV-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        
        return view('invoices.create', compact('businessId', 'invoiceNumber'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|max:20',
            'client_name' => 'required|string|max:255',
            'subtotal' => 'required|numeric|min:0',
            'gst_percentage' => 'required|numeric|min:0|max:100',
            'payment_status' => 'required|in:pending,paid,overdue',
        ]);

        $validated['business_id'] = $request->input('business_id');
        $validated['gst_amount'] = $validated['subtotal'] * ($validated['gst_percentage'] / 100);
        $validated['total_amount'] = $validated['subtotal'] + $validated['gst_amount'];
        
        Invoice::create($validated);
        
        return redirect()->route('invoices.index')
            ->with('success', 'Invoice created successfully.');
    }

    public function show(Request $request, Invoice $invoice)
    {
        if ($invoice->business_id != $request->input('business_id')) {
            abort(403);
        }
        
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Request $request, Invoice $invoice)
    {
        if ($invoice->business_id != $request->input('business_id')) {
            abort(403);
        }
        
        return view('invoices.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        if ($invoice->business_id != $request->input('business_id')) {
            abort(403);
        }

        $validated = $request->validate([
            'invoice_number' => 'required|string|max:20',
            'client_name' => 'required|string|max:255',
            'subtotal' => 'required|numeric|min:0',
            'gst_percentage' => 'required|numeric|min:0|max:100',
            'payment_status' => 'required|in:pending,paid,overdue',
        ]);

        $validated['gst_amount'] = $validated['subtotal'] * ($validated['gst_percentage'] / 100);
        $validated['total_amount'] = $validated['subtotal'] + $validated['gst_amount'];

        $invoice->update($validated);
        
        return redirect()->route('invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Request $request, Invoice $invoice)
    {
        if ($invoice->business_id != $request->input('business_id')) {
            abort(403);
        }

        $invoice->delete();
        
        return redirect()->route('invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

    public function pdf(Request $request, Invoice $invoice)
    {
        if ($invoice->business_id != $request->input('business_id')) {
            abort(403);
        }

        $business = $request->attributes->get('business');
        
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice', 'business'));
        
        return $pdf->download('invoice-' . $invoice->invoice_number . '.pdf');
    }
}

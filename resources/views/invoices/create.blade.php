@extends('layouts.app')

@section('title', 'Create Invoice')
@section('header', 'Create New Invoice')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Invoice Details</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('invoices.store') }}" id="invoiceForm">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="invoice_number" class="form-label">Invoice Number</label>
                            <input type="text" class="form-control @error('invoice_number') is-invalid @enderror" 
                                   id="invoice_number" name="invoice_number" value="{{ $invoiceNumber }}" readonly>
                            @error('invoice_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="client_name" class="form-label">Client Name</label>
                            <input type="text" class="form-control @error('client_name') is-invalid @enderror" 
                                   id="client_name" name="client_name" value="{{ old('client_name') }}" required>
                            @error('client_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="subtotal" class="form-label">Subtotal (₹)</label>
                            <input type="number" class="form-control @error('subtotal') is-invalid @enderror" 
                                   id="subtotal" name="subtotal" value="{{ old('subtotal') }}" 
                                   step="0.01" min="0" required onchange="calculateGST()">
                            @error('subtotal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="gst_percentage" class="form-label">GST Percentage (%)</label>
                            <select class="form-select @error('gst_percentage') is-invalid @enderror" 
                                    id="gst_percentage" name="gst_percentage" required onchange="calculateGST()">
                                <option value="0" {{ old('gst_percentage') == '0' ? 'selected' : '' }}>0%</option>
                                <option value="5" {{ old('gst_percentage') == '5' ? 'selected' : '' }}>5%</option>
                                <option value="12" {{ old('gst_percentage') == '12' ? 'selected' : '' }}>12%</option>
                                <option value="18" {{ old('gst_percentage') == '18' ? 'selected' : '' }}>18%</option>
                                <option value="28" {{ old('gst_percentage') == '28' ? 'selected' : '' }}>28%</option>
                            </select>
                            @error('gst_percentage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- GST Calculation Display -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">GST Calculation</h6>
                                    <div class="d-flex justify-content-between">
                                        <span>GST Amount:</span>
                                        <strong id="gstAmount">₹0.00</strong>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <span>Total Amount:</span>
                                        <strong id="totalAmount" class="text-primary">₹0.00</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="payment_status" class="form-label">Payment Status</label>
                            <select class="form-select @error('payment_status') is-invalid @enderror" 
                                    id="payment_status" name="payment_status" required>
                                <option value="">Select Status</option>
                                <option value="pending" {{ old('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ old('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="overdue" {{ old('payment_status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                            </select>
                            @error('payment_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Hidden fields for calculated values -->
                    <input type="hidden" id="gst_amount" name="gst_amount" value="0">
                    <input type="hidden" id="total_amount" name="total_amount" value="0">
                    <input type="hidden" name="business_id" value="{{ $businessId }}">
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('invoices.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Back to Invoices
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Create Invoice
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function calculateGST() {
    const subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
    const gstPercentage = parseFloat(document.getElementById('gst_percentage').value) || 0;
    
    const gstAmount = subtotal * (gstPercentage / 100);
    const totalAmount = subtotal + gstAmount;
    
    // Update display
    document.getElementById('gstAmount').textContent = '₹' + gstAmount.toFixed(2);
    document.getElementById('totalAmount').textContent = '₹' + totalAmount.toFixed(2);
    
    // Update hidden fields
    document.getElementById('gst_amount').value = gstAmount.toFixed(2);
    document.getElementById('total_amount').value = totalAmount.toFixed(2);
}

// Initialize calculation on page load
document.addEventListener('DOMContentLoaded', function() {
    calculateGST();
});
</script>
@endpush

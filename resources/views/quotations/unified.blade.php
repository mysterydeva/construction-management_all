@extends('layouts.unified')

@section('title', 'Quotations - Multi-Business ERP')

@section('page-title', 'Quotations')

@section('content')
@if($businessType === 'sales')
    <!-- Sales Mode - Show Quotations -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Quotation Management</h6>
                    <a href="{{ route('quotations.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Add Quotation
                    </a>
                </div>
                <div class="card-body">
                    @if(isset($quotations) && count($quotations) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Quote Number</th>
                                        <th>Client Name</th>
                                        <th>Project Name</th>
                                        <th>Amount</th>
                                        <th>GST</th>
                                        <th>Total</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quotations as $quotation)
                                        <tr>
                                            <td>{{ $quotation['id'] ?? '' }}</td>
                                            <td>{{ $quotation['quote_number'] ?? '' }}</td>
                                            <td>{{ $quotation['client_name'] ?? '' }}</td>
                                            <td>{{ $quotation['project_name'] ?? '' }}</td>
                                            <td>₹{{ number_format($quotation['amount'] ?? 0, 2) }}</td>
                                            <td>₹{{ number_format($quotation['gst'] ?? 0, 2) }}</td>
                                            <td>₹{{ number_format($quotation['total'] ?? 0, 2) }}</td>
                                            <td>{{ $quotation['due_date'] ?? '' }}</td>
                                            <td>
                                                <span class="badge bg-{{ ($quotation['status'] ?? '') === 'Paid' ? 'success' : 'warning' }}">
                                                    {{ $quotation['status'] ?? '' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('quotations.edit', $quotation['id']) }}" class="btn btn-sm btn-info">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('quotations.destroy', $quotation['id']) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-file-text" style="font-size: 4rem; color: #ccc;"></i>
                            <h5 class="mt-3">No quotations found</h5>
                            <p class="text-muted">Start by creating your first quotation.</p>
                            <a href="{{ route('quotations.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i> Create First Quotation
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@else
    <!-- Non-Sales Mode - Show Message -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quotation Management</h6>
                </div>
                <div class="card-body text-center py-5">
                    <i class="bi bi-info-circle" style="font-size: 4rem; color: #ccc;"></i>
                    <h5 class="mt-3">Quotations Not Available</h5>
                    <p class="text-muted">Quotation management is only available for Sales business type.</p>
                    <p class="text-muted">Current business type: <strong>{{ ucfirst($businessType ?? 'Unknown') }}</strong></p>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

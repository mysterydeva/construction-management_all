@extends('layouts.unified')

@section('title', 'Invoices - Multi-Business ERP')

@section('page-title', 'Invoices')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Invoice Management</h6>
                <a href="{{ route('invoices.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Add Invoice
                </a>
            </div>
            <div class="card-body">
                @if(isset($invoices) && count($invoices) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Invoice Number</th>
                                    <th>Client</th>
                                    <th>Project</th>
                                    <th>Amount</th>
                                    <th>GST</th>
                                    <th>Total</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice['id'] ?? '' }}</td>
                                        <td>{{ $invoice['invoice_number'] ?? '' }}</td>
                                        <td>{{ $invoice['client'] ?? '' }}</td>
                                        <td>{{ $invoice['project'] ?? '' }}</td>
                                        <td>₹{{ number_format($invoice['amount'] ?? 0, 2) }}</td>
                                        <td>₹{{ number_format($invoice['gst'] ?? 0, 2) }}</td>
                                        <td>₹{{ number_format($invoice['total'] ?? 0, 2) }}</td>
                                        <td>{{ $invoice['due_date'] ?? '' }}</td>
                                        <td>
                                            <span class="badge bg-{{ ($invoice['status'] ?? '') === 'Paid' ? 'success' : 'warning' }}">
                                                {{ $invoice['status'] ?? '' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('invoices.edit', $invoice['id']) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('invoices.destroy', $invoice['id']) }}" method="POST" style="display: inline;">
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
                        <i class="bi bi-file-earmark-text" style="font-size: 4rem; color: #ccc;"></i>
                        <h5 class="mt-3">No invoices found</h5>
                        <p class="text-muted">Start by creating your first invoice.</p>
                        <a href="{{ route('invoices.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i> Create First Invoice
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.unified')

@section('title', 'Expenses - Multi-Business ERP')

@section('page-title', 'Expenses')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Expense Management</h6>
                <a href="{{ route('expenses.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Add Expense
                </a>
            </div>
            <div class="card-body">
                @if(isset($expenses) && count($expenses) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expenses as $expense)
                                    <tr>
                                        <td>{{ $expense['id'] ?? '' }}</td>
                                        <td>{{ $expense['date'] ?? '' }}</td>
                                        <td>{{ $expense['description'] ?? '' }}</td>
                                        <td>{{ $expense['category'] ?? '' }}</td>
                                        <td>₹{{ number_format($expense['amount'] ?? 0, 2) }}</td>
                                        <td>{{ $expense['payment_method'] ?? '' }}</td>
                                        <td>
                                            <span class="badge bg-{{ ($expense['status'] ?? '') === 'Paid' ? 'success' : 'warning' }}">
                                                {{ $expense['status'] ?? '' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('expenses.edit', $expense['id']) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('expenses.destroy', $expense['id']) }}" method="POST" style="display: inline;">
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
                        <i class="bi bi-cash-stack" style="font-size: 4rem; color: #ccc;"></i>
                        <h5 class="mt-3">No expenses found</h5>
                        <p class="text-muted">Start by recording your first expense.</p>
                        <a href="{{ route('expenses.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i> Record First Expense
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.unified')

@section('title', 'Inventory - Multi-Business ERP')

@section('page-title', 'Inventory')

@section('content')
@if($businessType === 'construction')
    <!-- Construction Mode - Show Inventory -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Inventory Management</h6>
                    <a href="{{ route('inventory.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Add Item
                    </a>
                </div>
                <div class="card-body">
                    @if(isset($inventory) && count($inventory) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total Value</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($inventory as $item)
                                        <tr>
                                            <td>{{ $item['id'] ?? '' }}</td>
                                            <td>{{ $item['name'] ?? '' }}</td>
                                            <td>{{ $item['category'] ?? '' }}</td>
                                            <td>{{ $item['quantity'] ?? 0 }}</td>
                                            <td>₹{{ number_format($item['unit_price'] ?? 0, 2) }}</td>
                                            <td>₹{{ number_format($item['total_value'] ?? 0, 2) }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('inventory.edit', $item['id']) }}" class="btn btn-sm btn-info">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('inventory.destroy', $item['id']) }}" method="POST" style="display: inline;">
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
                            <i class="bi bi-box-seam" style="font-size: 4rem; color: #ccc;"></i>
                            <h5 class="mt-3">No inventory items found</h5>
                            <p class="text-muted">Start by adding your first inventory item.</p>
                            <a href="{{ route('inventory.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i> Add First Item
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@else
    <!-- Non-Construction Mode - Show Message -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Inventory Management</h6>
                </div>
                <div class="card-body text-center py-5">
                    <i class="bi bi-info-circle" style="font-size: 4rem; color: #ccc;"></i>
                    <h5 class="mt-3">Inventory Not Available</h5>
                    <p class="text-muted">Inventory management is only available for Construction business type.</p>
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

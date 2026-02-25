@extends('layouts.unified')

@section('title', 'Leads - Multi-Business ERP')

@section('page-title', 'Leads')

@section('content')
@if($businessType === 'sales')
    <!-- Sales Mode - Show Leads -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Lead Management</h6>
                    <a href="{{ route('leads.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Add Lead
                    </a>
                </div>
                <div class="card-body">
                    @if(isset($leads) && count($leads) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Company</th>
                                        <th>Source</th>
                                        <th>Status</th>
                                        <th>Budget</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leads as $lead)
                                        <tr>
                                            <td>{{ $lead['id'] ?? '' }}</td>
                                            <td>{{ $lead['name'] ?? '' }}</td>
                                            <td>{{ $lead['email'] ?? '' }}</td>
                                            <td>{{ $lead['phone'] ?? '' }}</td>
                                            <td>{{ $lead['company'] ?? '' }}</td>
                                            <td>{{ $lead['source'] ?? '' }}</td>
                                            <td>
                                                <span class="badge bg-{{ ($lead['status'] ?? '') === 'Qualified' ? 'success' : (($lead['status'] ?? '') === 'Converted' ? 'primary' : 'secondary') }}">
                                                    {{ $lead['status'] ?? '' }}
                                                </span>
                                            </td>
                                            <td>₹{{ number_format($lead['budget'] ?? 0, 2) }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('leads.edit', $lead['id']) }}" class="btn btn-sm btn-info">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('leads.destroy', $lead['id']) }}" method="POST" style="display: inline;">
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
                            <i class="bi bi-person-plus" style="font-size: 4rem; color: #ccc;"></i>
                            <h5 class="mt-3">No leads found</h5>
                            <p class="text-muted">Start by adding your first lead.</p>
                            <a href="{{ route('leads.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i> Add First Lead
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
                    <h6 class="m-0 font-weight-bold text-primary">Lead Management</h6>
                </div>
                <div class="card-body text-center py-5">
                    <i class="bi bi-info-circle" style="font-size: 4rem; color: #ccc;"></i>
                    <h5 class="mt-3">Leads Not Available</h5>
                    <p class="text-muted">Lead management is only available for Sales business type.</p>
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

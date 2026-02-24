@extends('layouts.app')

@section('title', 'Projects')
@section('header', 'Projects')

@section('actions')
<a href="{{ route('projects.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-circle me-2"></i>New Project
</a>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Projects</h6>
    </div>
    <div class="card-body">
        @if($projects->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Client Name</th>
                        <th>Estimated Cost</th>
                        <th>Actual Cost</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->project_name }}</td>
                        <td>{{ $project->client_name }}</td>
                        <td>₹{{ number_format($project->estimated_cost, 2) }}</td>
                        <td>
                            @if($project->actual_cost)
                                ₹{{ number_format($project->actual_cost, 2) }}
                            @else
                                <span class="text-muted">Not set</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $project->status === 'completed' ? 'success' : ($project->status === 'active' ? 'primary' : ($project->status === 'planning' ? 'info' : 'danger')) }}">
                                {{ ucfirst($project->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display: inline;">
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
        
            <div class="d-flex justify-content-between">
                <div>
                    Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of {{ $projects->total() }} entries
                </div>
                {{ $projects->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-building display-1 text-muted"></i>
                <h4 class="mt-3 text-muted">No Projects Found</h4>
                <p class="text-muted">Get started by creating your first project.</p>
                <a href="{{ route('projects.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Create Project
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

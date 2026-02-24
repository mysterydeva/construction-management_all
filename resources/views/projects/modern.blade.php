@extends('layouts.modern')

@section('title', 'Projects')
@section('page-title', 'Projects')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Projects</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Projects</h1>
        <a href="#" class="btn btn-primary" onclick="showCreateForm()">
            <i class="bi bi-plus-circle me-2"></i>New Project
        </a>
    </div>

    <!-- Projects Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Projects</h6>
        </div>
        <div class="card-body">
            <!-- Search Bar -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Search projects..." id="searchInput">
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Client</th>
                            <th>Status</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Budget</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="projectsTable">
                        <tr>
                            <td>Office Complex Construction</td>
                            <td>ABC Corporation</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>2024-01-15</td>
                            <td>2024-06-30</td>
                            <td class="text-end">₹2,500,000</td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewProject('Office Complex Construction')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editProject('Office Complex Construction')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Office Complex Construction')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Residential Building</td>
                            <td>XYZ Developers</td>
                            <td><span class="badge bg-warning">Planning</span></td>
                            <td>2024-03-01</td>
                            <td>2024-12-31</td>
                            <td class="text-end">₹1,800,000</td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewProject('Residential Building')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editProject('Residential Building')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Residential Building')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Warehouse Construction</td>
                            <td>Logistics Ltd</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>2023-09-01</td>
                            <td>2024-01-15</td>
                            <td class="text-end">₹1,200,000</td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewProject('Warehouse Construction')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editProject('Warehouse Construction')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Warehouse Construction')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav aria-label="Projects pagination">
                <ul class="pagination justify-content-end">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Create/Edit Modal -->
<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="projectForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="projectName" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="projectName" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="clientName" class="form-label">Client Name</label>
                            <input type="text" class="form-control" id="clientName" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="startDate" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="endDate" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" required>
                                <option value="Planning">Planning</option>
                                <option value="Active">Active</option>
                                <option value="Completed">Completed</option>
                                <option value="On Hold">On Hold</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="budget" class="form-label">Budget (₹)</label>
                            <input type="number" class="form-control" id="budget" min="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="projectManager" class="form-label">Project Manager</label>
                            <input type="text" class="form-control" id="projectManager">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveProject()">Save Project</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete "<span id="deleteItemName"></span>"? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="deleteItem()">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#projectsTable tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Create/Edit functionality
    function showCreateForm() {
        document.getElementById('projectModalLabel').textContent = 'New Project';
        document.getElementById('projectForm').reset();
        const modal = new bootstrap.Modal(document.getElementById('projectModal'));
        modal.show();
    }
    
    function editProject(projectName) {
        document.getElementById('projectModalLabel').textContent = 'Edit Project';
        // Load project data (for demo, just show modal)
        const modal = new bootstrap.Modal(document.getElementById('projectModal'));
        modal.show();
    }
    
    function viewProject(projectName) {
        showAlert(`Viewing project: ${projectName}`, 'info');
    }
    
    function saveProject() {
        const form = document.getElementById('projectForm');
        if (form.checkValidity()) {
            document.getElementById('loadingSpinner').classList.add('show');
            
            setTimeout(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('projectModal'));
                modal.hide();
                
                showAlert('Project saved successfully!', 'success');
                document.getElementById('loadingSpinner').classList.remove('show');
                
                setTimeout(() => {
                    location.reload();
                }, 1500);
            }, 1000);
        } else {
            form.reportValidity();
        }
    }

    // Delete confirmation
    let itemToDelete = null;
    
    function confirmDelete(itemName) {
        itemToDelete = itemName;
        document.getElementById('deleteItemName').textContent = itemName;
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }
    
    function deleteItem() {
        if (itemToDelete) {
            document.getElementById('loadingSpinner').classList.add('show');
            
            setTimeout(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                modal.hide();
                
                showAlert('Project deleted successfully!', 'success');
                document.getElementById('loadingSpinner').classList.remove('show');
                
                setTimeout(() => {
                    location.reload();
                }, 1500);
            }, 1000);
        }
    }
    
    function showAlert(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show mt-3`;
        alertDiv.innerHTML = `
            <i class="bi bi-check-circle me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        const mainContent = document.querySelector('main');
        mainContent.insertBefore(alertDiv, mainContent.firstChild);
        
        setTimeout(() => {
            alertDiv.classList.remove('show');
        }, 5000);
    }
</script>
@endsection

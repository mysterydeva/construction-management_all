@extends('layouts.unified')

@section('title', 'Projects - Multi-Business ERP')

@section('page-title', 'Projects')

@section('content')
<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Projects</h1>
    <button class="btn btn-primary" onclick="showCreateForm()">
        <i class="bi bi-plus-circle me-2"></i>New Project
    </button>
</div>

<!-- Business Type Specific Content -->
@if(session('business_type') === 'sales')
    <!-- Sales Business - Projects as Sales Opportunities -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="empty-state">
                <i class="bi bi-info-circle"></i>
                <h4>Sales Business Mode</h4>
                <p class="text-muted">In Sales mode, projects are managed as "Sales Opportunities".</p>
                <p>Use the <strong>Leads</strong> module to track and convert sales opportunities.</p>
                <a href="{{ route('leads.index') }}" class="btn btn-primary">
                    <i class="bi bi-arrow-right me-2"></i>Go to Leads
                </a>
            </div>
        </div>
    </div>
@elseif(session('business_type') === 'design')
    <!-- Design Business - Design Projects -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Design Projects</h6>
        </div>
        <div class="card-body">
            <!-- Search and Filter -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Search design projects..." id="searchInput">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="Planning">Planning</option>
                        <option value="Active">Active</option>
                        <option value="Completed">Completed</option>
                        <option value="On Hold">On Hold</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="roomTypeFilter">
                        <option value="">All Room Types</option>
                        <option value="Living Room">Living Room</option>
                        <option value="Bedroom">Bedroom</option>
                        <option value="Kitchen">Kitchen</option>
                        <option value="Bathroom">Bathroom</option>
                        <option value="Office">Office</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>

            <!-- Projects Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Client</th>
                            <th>Room Type</th>
                            <th>Status</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Budget</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="projectsTable">
                        <tr>
                            <td>Living Room Makeover</td>
                            <td>Priya Sharma</td>
                            <td>Living Room</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>2024-01-10</td>
                            <td>2024-02-15</td>
                            <td class="text-end">₹150,000</td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewProject('Living Room Makeover')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editProject('Living Room Makeover')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Living Room Makeover')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Master Bedroom Design</td>
                            <td>Rahul Verma</td>
                            <td>Bedroom</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>2024-01-20</td>
                            <td>2024-03-01</td>
                            <td class="text-end">₹200,000</td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewProject('Master Bedroom Design')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editProject('Master Bedroom Design')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Master Bedroom Design')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Kitchen Renovation</td>
                            <td>Anjali Patel</td>
                            <td>Kitchen</td>
                            <td><span class="badge bg-warning">Active</span></td>
                            <td>2024-02-01</td>
                            <td>2024-04-15</td>
                            <td class="text-end">₹300,000</td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewProject('Kitchen Renovation')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editProject('Kitchen Renovation')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Kitchen Renovation')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Office Interior</td>
                            <td>Tech Solutions Ltd</td>
                            <td>Office</td>
                            <td><span class="badge bg-warning">Active</span></td>
                            <td>2024-02-15</td>
                            <td>2024-05-01</td>
                            <td class="text-end">₹200,000</td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewProject('Office Interior')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editProject('Office Interior')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Office Interior')">
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
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@else
    <!-- Construction Business - Construction Projects -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Construction Projects</h6>
        </div>
        <div class="card-body">
            <!-- Search and Filter -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Search construction projects..." id="searchInput">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="Planning">Planning</option>
                        <option value="Active">Active</option>
                        <option value="Completed">Completed</option>
                        <option value="On Hold">On Hold</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="projectTypeFilter">
                        <option value="">All Project Types</option>
                        <option value="Commercial">Commercial</option>
                        <option value="Residential">Residential</option>
                        <option value="Industrial">Industrial</option>
                        <option value="Infrastructure">Infrastructure</option>
                    </select>
                </div>
            </div>

            <!-- Projects Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Client</th>
                            <th>Type</th>
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
                            <td>Commercial</td>
                            <td><span class="badge bg-warning">Active</span></td>
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
                            <td>Residential</td>
                            <td><span class="badge bg-warning">Active</span></td>
                            <td>2024-02-01</td>
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
                            <td>Industrial</td>
                            <td><span class="badge bg-info">Planning</span></td>
                            <td>2024-03-01</td>
                            <td>2024-08-31</td>
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
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endif
@endsection

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        filterProjects();
    });

    // Filter functionality
    document.getElementById('statusFilter')?.addEventListener('change', filterProjects);
    document.getElementById('projectTypeFilter')?.addEventListener('change', filterProjects);
    document.getElementById('roomTypeFilter')?.addEventListener('change', filterProjects);

    function filterProjects() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter')?.value.toLowerCase() || '';
        const typeFilter = document.getElementById('projectTypeFilter')?.value.toLowerCase() || '';
        const roomTypeFilter = document.getElementById('roomTypeFilter')?.value.toLowerCase() || '';
        
        const rows = document.querySelectorAll('#projectsTable tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const matchesSearch = !searchTerm || text.includes(searchTerm);
            const matchesStatus = !statusFilter || text.includes(statusFilter);
            const matchesType = !typeFilter || text.includes(typeFilter);
            const matchesRoomType = !roomTypeFilter || text.includes(roomTypeFilter);
            
            row.style.display = matchesSearch && matchesStatus && matchesType && matchesRoomType ? '' : 'none';
        });
    }

    // CRUD operations
    function showCreateForm() {
        alert('Create project form would open here');
    }
    
    function viewProject(projectName) {
        alert(`Viewing project: ${projectName}`);
    }
    
    function editProject(projectName) {
        alert(`Editing project: ${projectName}`);
    }
    
    function confirmDelete(projectName) {
        if (confirm(`Are you sure you want to delete "${projectName}"?`)) {
            alert(`Project "${projectName}" would be deleted`);
        }
    }
</script>
@endpush

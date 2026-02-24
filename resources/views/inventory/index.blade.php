@extends('layouts.modern')

@section('title', 'Inventory')
@section('page-title', 'Inventory')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Inventory</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Inventory</h1>
        <a href="#" class="btn btn-primary" onclick="showCreateForm()">
            <i class="bi bi-plus-circle me-2"></i>Add Item
        </a>
    </div>

    <!-- Inventory Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Inventory Items</h6>
        </div>
        <div class="card-body">
            <!-- Search Bar -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Search inventory..." id="searchInput">
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Value</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="inventoryTable">
                        <tr>
                            <td>Cement Bags</td>
                            <td>Building Materials</td>
                            <td>500</td>
                            <td class="text-end">₹350</td>
                            <td class="text-end">₹175,000</td>
                            <td><span class="badge bg-success">In Stock</span></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewItem('Cement Bags')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editItem('Cement Bags')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Cement Bags')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Steel Rods</td>
                            <td>Building Materials</td>
                            <td>200</td>
                            <td class="text-end">₹1,200</td>
                            <td class="text-end">₹240,000</td>
                            <td><span class="badge bg-success">In Stock</span></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewItem('Steel Rods')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editItem('Steel Rods')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Steel Rods')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Bricks</td>
                            <td>Building Materials</td>
                            <td>50</td>
                            <td class="text-end">₹8</td>
                            <td class="text-end">₹40,000</td>
                            <td><span class="badge bg-warning">Low Stock</span></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewItem('Bricks')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editItem('Bricks')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Bricks')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Paint</td>
                            <td>Finishing Materials</td>
                            <td>100</td>
                            <td class="text-end">₹450</td>
                            <td class="text-end">₹45,000</td>
                            <td><span class="badge bg-success">In Stock</span></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewItem('Paint')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editItem('Paint')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Paint')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>PVC Pipes</td>
                            <td>Plumbing</td>
                            <td>25</td>
                            <td class="text-end">₹800</td>
                            <td class="text-end">₹20,000</td>
                            <td><span class="badge bg-danger">Out of Stock</span></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewItem('PVC Pipes')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editItem('PVC Pipes')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('PVC Pipes')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav aria-label="Inventory pagination">
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
</div>

<!-- Create/Edit Modal -->
<div class="modal fade" id="inventoryModal" tabindex="-1" aria-labelledby="inventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inventoryModalLabel">Add Inventory Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="inventoryForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="itemName" class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="itemName" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" required>
                                <option value="">Select Category</option>
                                <option value="Building Materials">Building Materials</option>
                                <option value="Finishing Materials">Finishing Materials</option>
                                <option value="Plumbing">Plumbing</option>
                                <option value="Electrical">Electrical</option>
                                <option value="Tools">Tools</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" min="0" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="unitPrice" class="form-label">Unit Price (₹)</label>
                            <input type="number" class="form-control" id="unitPrice" min="0" step="0.01" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" required>
                                <option value="In Stock">In Stock</option>
                                <option value="Low Stock">Low Stock</option>
                                <option value="Out of Stock">Out of Stock</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="supplier" class="form-label">Supplier</label>
                            <input type="text" class="form-control" id="supplier">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Storage Location</label>
                            <input type="text" class="form-control" id="location">
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
                <button type="button" class="btn btn-primary" onclick="saveInventory()">Save Item</button>
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
        const rows = document.querySelectorAll('#inventoryTable tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Create/Edit functionality
    function showCreateForm() {
        document.getElementById('inventoryModalLabel').textContent = 'Add Inventory Item';
        document.getElementById('inventoryForm').reset();
        const modal = new bootstrap.Modal(document.getElementById('inventoryModal'));
        modal.show();
    }
    
    function editItem(itemName) {
        document.getElementById('inventoryModalLabel').textContent = 'Edit Inventory Item';
        // Load item data (for demo, just show modal)
        const modal = new bootstrap.Modal(document.getElementById('inventoryModal'));
        modal.show();
    }
    
    function viewItem(itemName) {
        showAlert(`Viewing inventory item: ${itemName}`, 'info');
    }
    
    function saveInventory() {
        const form = document.getElementById('inventoryForm');
        if (form.checkValidity()) {
            document.getElementById('loadingSpinner').classList.add('show');
            
            setTimeout(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('inventoryModal'));
                modal.hide();
                
                showAlert('Inventory item saved successfully!', 'success');
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
                
                showAlert('Inventory item deleted successfully!', 'success');
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

@extends('layouts.modern')

@section('title', 'Quotations')
@section('page-title', 'Quotations')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Quotations</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quotations</h1>
        <a href="#" class="btn btn-primary" onclick="showCreateForm()">
            <i class="bi bi-plus-circle me-2"></i>New Quotation
        </a>
    </div>

    <!-- Quotations Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Quotations</h6>
        </div>
        <div class="card-body">
            <!-- Search Bar -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Search quotations..." id="searchInput">
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Quote #</th>
                            <th>Client</th>
                            <th>Project</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Valid Until</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="quotationsTable">
                        <tr>
                            <td>Q-2024-001</td>
                            <td>Rahul Sharma</td>
                            <td>Office Windows</td>
                            <td class="text-end">₹45,000</td>
                            <td><span class="badge bg-success">Accepted</span></td>
                            <td>2024-02-10</td>
                            <td>2024-03-10</td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewQuotation('Q-2024-001')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editQuotation('Q-2024-001')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Q-2024-001')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Q-2024-002</td>
                            <td>Priya Patel</td>
                            <td>Home Doors</td>
                            <td class="text-end">₹38,500</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>2024-02-08</td>
                            <td>2024-03-08</td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewQuotation('Q-2024-002')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editQuotation('Q-2024-002')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Q-2024-002')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Q-2024-003</td>
                            <td>Amit Kumar</td>
                            <td>Shop Front</td>
                            <td class="text-end">₹52,000</td>
                            <td><span class="badge bg-success">Accepted</span></td>
                            <td>2024-02-05</td>
                            <td>2024-03-05</td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewQuotation('Q-2024-003')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editQuotation('Q-2024-003')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Q-2024-003')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Q-2024-004</td>
                            <td>Sneha Reddy</td>
                            <td>Bathroom Windows</td>
                            <td class="text-end">₹17,900</td>
                            <td><span class="badge bg-danger">Rejected</span></td>
                            <td>2024-02-03</td>
                            <td>2024-03-03</td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewQuotation('Q-2024-004')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editQuotation('Q-2024-004')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Q-2024-004')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav aria-label="Quotations pagination">
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
<div class="modal fade" id="quotationModal" tabindex="-1" aria-labelledby="quotationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quotationModalLabel">New Quotation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="quotationForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="clientName" class="form-label">Client Name</label>
                            <input type="text" class="form-control" id="clientName" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="projectName" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="projectName" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="quoteDate" class="form-label">Quote Date</label>
                            <input type="date" class="form-control" id="quoteDate" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validUntil" class="form-label">Valid Until</label>
                            <input type="date" class="form-control" id="validUntil" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" required>
                                <option value="Draft">Draft</option>
                                <option value="Pending">Pending</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Quotation Items -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">Quotation Items</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="itemsTable">
                                    <thead>
                                        <tr>
                                            <th>Item Description</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control" placeholder="Item description"></td>
                                            <td><input type="number" class="form-control text-end" placeholder="Qty" min="0" onchange="calculateRowTotal(this)"></td>
                                            <td><input type="number" class="form-control text-end" placeholder="Price" min="0" step="0.01" onchange="calculateRowTotal(this)"></td>
                                            <td class="text-end">₹0.00</td>
                                            <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="removeRow(this)"><i class="bi bi-trash"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addRow()">
                                <i class="bi bi-plus-circle me-1"></i>Add Item
                            </button>
                        </div>
                    </div>
                    
                    <!-- Summary -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control" id="notes" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-6">Subtotal:</div>
                                        <div class="col-6 text-end" id="subtotal">₹0.00</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6">GST (18%):</div>
                                        <div class="col-6 text-end" id="gst">₹0.00</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 fw-bold">Total:</div>
                                        <div class="col-6 text-end fw-bold" id="total">₹0.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveQuotation()">Save Quotation</button>
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
        const rows = document.querySelectorAll('#quotationsTable tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Create/Edit functionality
    function showCreateForm() {
        document.getElementById('quotationModalLabel').textContent = 'New Quotation';
        document.getElementById('quotationForm').reset();
        // Add default empty row
        const tbody = document.querySelector('#itemsTable tbody');
        tbody.innerHTML = `
            <tr>
                <td><input type="text" class="form-control" placeholder="Item description"></td>
                <td><input type="number" class="form-control text-end" placeholder="Qty" min="0" onchange="calculateRowTotal(this)"></td>
                <td><input type="number" class="form-control text-end" placeholder="Price" min="0" step="0.01" onchange="calculateRowTotal(this)"></td>
                <td class="text-end">₹0.00</td>
                <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="removeRow(this)"><i class="bi bi-trash"></i></button></td>
            </tr>
        `;
        calculateTotals();
        const modal = new bootstrap.Modal(document.getElementById('quotationModal'));
        modal.show();
    }
    
    function editQuotation(quoteNumber) {
        document.getElementById('quotationModalLabel').textContent = 'Edit Quotation';
        // Load quotation data (for demo, just show modal)
        const modal = new bootstrap.Modal(document.getElementById('quotationModal'));
        modal.show();
    }
    
    function viewQuotation(quoteNumber) {
        showAlert(`Viewing quotation: ${quoteNumber}`, 'info');
    }
    
    function saveQuotation() {
        const form = document.getElementById('quotationForm');
        if (form.checkValidity()) {
            document.getElementById('loadingSpinner').classList.add('show');
            
            setTimeout(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('quotationModal'));
                modal.hide();
                
                showAlert('Quotation saved successfully!', 'success');
                document.getElementById('loadingSpinner').classList.remove('show');
                
                setTimeout(() => {
                    location.reload();
                }, 1500);
            }, 1000);
        } else {
            form.reportValidity();
        }
    }

    // Item management
    function addRow() {
        const tbody = document.querySelector('#itemsTable tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" class="form-control" placeholder="Item description"></td>
            <td><input type="number" class="form-control text-end" placeholder="Qty" min="0" onchange="calculateRowTotal(this)"></td>
            <td><input type="number" class="form-control text-end" placeholder="Price" min="0" step="0.01" onchange="calculateRowTotal(this)"></td>
            <td class="text-end">₹0.00</td>
            <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="removeRow(this)"><i class="bi bi-trash"></i></button></td>
        `;
        tbody.appendChild(newRow);
    }
    
    function removeRow(button) {
        const row = button.closest('tr');
        const tbody = row.parentNode;
        if (tbody.children.length > 1) {
            row.remove();
            calculateTotals();
        }
    }
    
    function calculateRowTotal(input) {
        const row = input.closest('tr');
        const quantity = parseFloat(row.querySelector('td:nth-child(2) input').value) || 0;
        const price = parseFloat(row.querySelector('td:nth-child(3) input').value) || 0;
        const total = quantity * price;
        row.querySelector('td:nth-child(4)').textContent = `₹${total.toFixed(2)}`;
        calculateTotals();
    }
    
    function calculateTotals() {
        const rows = document.querySelectorAll('#itemsTable tbody tr');
        let subtotal = 0;
        
        rows.forEach(row => {
            const totalText = row.querySelector('td:nth-child(4)').textContent;
            const total = parseFloat(totalText.replace('₹', '')) || 0;
            subtotal += total;
        });
        
        const gst = subtotal * 0.18;
        const total = subtotal + gst;
        
        document.getElementById('subtotal').textContent = `₹${subtotal.toFixed(2)}`;
        document.getElementById('gst').textContent = `₹${gst.toFixed(2)}`;
        document.getElementById('total').textContent = `₹${total.toFixed(2)}`;
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
                
                showAlert('Quotation deleted successfully!', 'success');
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

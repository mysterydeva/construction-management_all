@extends('layouts.modern')

@section('title', 'Expenses')
@section('page-title', 'Expenses')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Expenses</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Expenses</h1>
        <a href="#" class="btn btn-primary" onclick="showCreateForm()">
            <i class="bi bi-plus-circle me-2"></i>New Expense
        </a>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">This Month</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹45,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Last Month</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹38,500</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-graph-down fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">YTD Total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹585,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cash-stack fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹12,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Expenses Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Expenses</h6>
        </div>
        <div class="card-body">
            <!-- Search and Filter Bar -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Search expenses..." id="searchInput">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="categoryFilter">
                        <option value="">All Categories</option>
                        <option value="Materials">Materials</option>
                        <option value="Labor">Labor</option>
                        <option value="Equipment">Equipment</option>
                        <option value="Office">Office</option>
                        <option value="Travel">Travel</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="Paid">Paid</option>
                        <option value="Pending">Pending</option>
                        <option value="Overdue">Overdue</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-secondary" onclick="clearFilters()">
                        <i class="bi bi-x-circle me-1"></i>Clear
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="expensesTable">
                        <tr>
                            <td>2024-02-20</td>
                            <td>Cement Purchase - 100 bags</td>
                            <td>Materials</td>
                            <td class="text-end">₹35,000</td>
                            <td>Bank Transfer</td>
                            <td><span class="badge bg-success">Paid</span></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewExpense('Cement Purchase')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editExpense('Cement Purchase')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Cement Purchase')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2024-02-18</td>
                            <td>Steel Rods - 2 tons</td>
                            <td>Materials</td>
                            <td class="text-end">₹120,000</td>
                            <td>Cheque</td>
                            <td><span class="badge bg-success">Paid</span></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewExpense('Steel Rods')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editExpense('Steel Rods')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Steel Rods')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2024-02-15</td>
                            <td>Worker Wages - Week 1</td>
                            <td>Labor</td>
                            <td class="text-end">₹25,000</td>
                            <td>Cash</td>
                            <td><span class="badge bg-success">Paid</span></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewExpense('Worker Wages')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editExpense('Worker Wages')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Worker Wages')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2024-02-12</td>
                            <td>Equipment Rental - Crane</td>
                            <td>Equipment</td>
                            <td class="text-end">₹15,000</td>
                            <td>Bank Transfer</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewExpense('Equipment Rental')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editExpense('Equipment Rental')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Equipment Rental')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2024-02-10</td>
                            <td>Office Rent - February</td>
                            <td>Office</td>
                            <td class="text-end">₹8,000</td>
                            <td>Cheque</td>
                            <td><span class="badge bg-success">Paid</span></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewExpense('Office Rent')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editExpense('Office Rent')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Office Rent')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2024-02-08</td>
                            <td>Fuel - Site Vehicle</td>
                            <td>Travel</td>
                            <td class="text-end">₹3,500</td>
                            <td>Cash</td>
                            <td><span class="badge bg-success">Paid</span></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewExpense('Fuel')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editExpense('Fuel')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Fuel')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2024-02-05</td>
                            <td>Electrical Supplies</td>
                            <td>Materials</td>
                            <td class="text-end">₹12,000</td>
                            <td>Credit Card</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewExpense('Electrical Supplies')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-warning" onclick="editExpense('Electrical Supplies')">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('Electrical Supplies')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav aria-label="Expenses pagination">
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
<div class="modal fade" id="expenseModal" tabindex="-1" aria-labelledby="expenseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="expenseModalLabel">New Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="expenseForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="expenseDate" class="form-label">Expense Date</label>
                            <input type="date" class="form-control" id="expenseDate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" required>
                                <option value="">Select Category</option>
                                <option value="Materials">Materials</option>
                                <option value="Labor">Labor</option>
                                <option value="Equipment">Equipment</option>
                                <option value="Office">Office</option>
                                <option value="Travel">Travel</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" required>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="amount" class="form-label">Amount (₹)</label>
                            <input type="number" class="form-control" id="amount" min="0" step="0.01" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="paymentMethod" class="form-label">Payment Method</label>
                            <select class="form-select" id="paymentMethod" required>
                                <option value="">Select Method</option>
                                <option value="Cash">Cash</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="Debit Card">Debit Card</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" required>
                                <option value="Paid">Paid</option>
                                <option value="Pending">Pending</option>
                                <option value="Overdue">Overdue</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="vendor" class="form-label">Vendor/Supplier</label>
                            <input type="text" class="form-control" id="vendor">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="reference" class="form-label">Reference #</label>
                            <input type="text" class="form-control" id="reference">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="receipt" class="form-label">Receipt/Invoice #</label>
                        <input type="text" class="form-control" id="receipt">
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hasReceipt">
                            <label class="form-check-label" for="hasReceipt">
                                I have a receipt for this expense
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveExpense()">Save Expense</button>
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
        filterExpenses();
    });

    // Filter functionality
    document.getElementById('categoryFilter').addEventListener('change', filterExpenses);
    document.getElementById('statusFilter').addEventListener('change', filterExpenses);

    function filterExpenses() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const categoryFilter = document.getElementById('categoryFilter').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
        const rows = document.querySelectorAll('#expensesTable tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const matchesSearch = text.includes(searchTerm);
            const matchesCategory = !categoryFilter || text.includes(categoryFilter);
            const matchesStatus = !statusFilter || text.includes(statusFilter);
            
            row.style.display = matchesSearch && matchesCategory && matchesStatus ? '' : 'none';
        });
    }

    function clearFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('categoryFilter').value = '';
        document.getElementById('statusFilter').value = '';
        filterExpenses();
    }

    // Create/Edit functionality
    function showCreateForm() {
        document.getElementById('expenseModalLabel').textContent = 'New Expense';
        document.getElementById('expenseForm').reset();
        // Set default date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('expenseDate').value = today;
        
        const modal = new bootstrap.Modal(document.getElementById('expenseModal'));
        modal.show();
    }
    
    function editExpense(expenseName) {
        document.getElementById('expenseModalLabel').textContent = 'Edit Expense';
        // Load expense data (for demo, just show modal)
        const modal = new bootstrap.Modal(document.getElementById('expenseModal'));
        modal.show();
    }
    
    function viewExpense(expenseName) {
        showAlert(`Viewing expense: ${expenseName}`, 'info');
    }
    
    function saveExpense() {
        const form = document.getElementById('expenseForm');
        if (form.checkValidity()) {
            document.getElementById('loadingSpinner').classList.add('show');
            
            setTimeout(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('expenseModal'));
                modal.hide();
                
                showAlert('Expense saved successfully!', 'success');
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
                
                showAlert('Expense deleted successfully!', 'success');
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

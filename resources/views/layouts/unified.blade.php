<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Multi-Business ERP System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
        }
        
        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: var(--light-color);
        }
        
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--primary-color) 10%, #224abe 100%);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .sidebar.sales {
            background: linear-gradient(180deg, #1cc88a 10%, #13855c 100%);
        }
        
        .sidebar.design {
            background: linear-gradient(180deg, #f6c23e 10%, #dd9a08 100%);
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 1rem 1.5rem;
            border-radius: 0.35rem;
            margin: 0.25rem 0.75rem;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar .nav-link i {
            margin-right: 0.5rem;
        }
        
        .topbar {
            background-color: white;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            padding: 1rem 1.5rem;
        }
        
        .business-selector {
            background: linear-gradient(135deg, var(--primary-color), #2e59d9);
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.35rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .business-selector:hover {
            transform: translateY(-1px);
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.15);
        }
        
        .dropdown-menu.show {
            display: block !important;
        }
        
        .dropdown-menu {
            display: none;
            position: absolute;
            z-index: 1000;
            min-width: 10rem;
            padding: 0.5rem 0;
            margin: 0;
            font-size: 0.875rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 0.35rem;
        }
        
        .dropdown-menu li {
            padding: 0;
        }
        
        .dropdown-menu .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.25rem 1rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: inherit;
            text-decoration: none;
            white-space: nowrap;
            background-color: transparent;
            border: 0;
        }
        
        .dropdown-menu .dropdown-item:hover,
        .dropdown-menu .dropdown-item:focus {
            color: #16181b;
            background-color: #e9ecef;
        }
        
        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid #e3e6f0;
            font-weight: 600;
            color: var(--dark-color);
        }
        
        .metric-card {
            border-left: 0.25rem solid;
            transition: all 0.3s ease;
        }
        
        .metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.2);
        }
        
        .metric-card.primary { border-left-color: var(--primary-color); }
        .metric-card.success { border-left-color: var(--success-color); }
        .metric-card.info { border-left-color: var(--info-color); }
        .metric-card.warning { border-left-color: var(--warning-color); }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }
        
        .table {
            background-color: white;
        }
        
        .table th {
            border-top: none;
            font-weight: 600;
            color: var(--dark-color);
            background-color: #f8f9fc;
        }
        
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 1rem;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            color: var(--secondary-color);
        }
        
        .loading-spinner {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
        
        .loading-spinner.show {
            display: flex;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--secondary-color);
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
    </style>
    <!-- Direct CSS and JS includes instead of Vite -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- Loading Spinner -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar {{ session('business_type') }} collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h5 class="text-white fw-bold">Multi-Business ERP</h5>
                        <small class="text-white-50">Unified Platform</small>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('projects*') ? 'active' : '' }}" href="{{ route('projects.index') }}">
                                <i class="bi bi-building"></i> Projects
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('inventory*') ? 'active' : '' }}" href="{{ route('inventory.index') }}">
                                <i class="bi bi-box-seam"></i> Inventory
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('leads*') ? 'active' : '' }}" href="{{ route('leads.index') }}">
                                <i class="bi bi-person-plus"></i> Leads
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('quotations*') ? 'active' : '' }}" href="{{ route('quotations.index') }}">
                                <i class="bi bi-file-text"></i> Quotations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('invoices*') ? 'active' : '' }}" href="{{ route('invoices.index') }}">
                                <i class="bi bi-file-earmark-text"></i> Invoices
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('expenses*') ? 'active' : '' }}" href="{{ route('expenses.index') }}">
                                <i class="bi bi-cash-stack"></i> Expenses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('reports*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                                <i class="bi bi-graph-up"></i> Reports
                            </a>
                        </li>
                    </ul>
                    
                    <hr class="sidebar-divider">
                    
                    <div class="text-center">
                        <a href="#" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </div>
                </div>
            </nav>
            
            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Topbar -->
                <div class="topbar d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <!-- Business Type Selector -->
                        <div class="dropdown me-3">
                            <button class="btn business-selector dropdown-toggle" type="button" id="businessTypeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-building me-2"></i>
                                @if(session('business_type', 'construction') === 'construction')
                                    Construction Management
                                @elseif(session('business_type', 'construction') === 'sales')
                                    Sales Management
                                @elseif(session('business_type', 'construction') === 'design')
                                    Design Management
                                @else
                                    Business Management
                                @endif
                                <i class="bi bi-chevron-down ms-2"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="businessTypeDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['business_type' => 'construction']) }}">
                                        <i class="bi bi-hammer me-2"></i> Construction Management
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['business_type' => 'sales']) }}">
                                        <i class="bi bi-person-plus me-2"></i> Sales Management
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['business_type' => 'design']) }}">
                                        <i class="bi bi-palette me-2"></i> Design Management
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">@yield('page-title')</li>
                            </ol>
                        </nav>
                    </div>
                    
                    <div class="dropdown">
                        <a class="btn btn-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i>
                            Admin User
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                <!-- Main Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize dropdowns manually
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing dropdowns...');
            
            // Method 1: Try Bootstrap's automatic initialization first
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            console.log('Found dropdown elements:', dropdownElementList.length);
            
            // Method 2: Manual initialization if automatic doesn't work
            if (dropdownElementList.length > 0) {
                try {
                    dropdownElementList.map(function (dropdownToggleEl) {
                        console.log('Initializing dropdown:', dropdownToggleEl);
                        var dropdown = new bootstrap.Dropdown(dropdownToggleEl);
                        console.log('Dropdown initialized:', dropdown);
                    });
                } catch (error) {
                    console.error('Error initializing dropdowns:', error);
                    // Fallback: Manual dropdown implementation
                    initManualDropdowns();
                }
            }
            
            // Test dropdown functionality
            var testButton = document.querySelector('.business-selector');
            if (testButton) {
                console.log('Business selector button found:', testButton);
                testButton.addEventListener('click', function(e) {
                    console.log('Business selector clicked!');
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Toggle dropdown manually if Bootstrap doesn't work
                    var dropdownMenu = testButton.nextElementSibling;
                    if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')) {
                        dropdownMenu.classList.toggle('show');
                    }
                });
            }
        });
        
        // Manual dropdown implementation
        function initManualDropdowns() {
            console.log('Initializing manual dropdowns...');
            document.querySelectorAll('.dropdown-toggle').forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    var dropdownMenu = button.nextElementSibling;
                    if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')) {
                        // Close other dropdowns
                        document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                            if (menu !== dropdownMenu) {
                                menu.classList.remove('show');
                            }
                        });
                        
                        // Toggle current dropdown
                        dropdownMenu.classList.toggle('show');
                    }
                });
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                        menu.classList.remove('show');
                    });
                }
            });
        }
    </script>
</body>
</html>

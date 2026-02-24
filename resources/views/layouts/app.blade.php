<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ERP System') - {{ $currentBusiness->name ?? 'Multi-Business ERP' }}</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    @stack('styles')
</head>
<body>
    @if(session()->has('user'))
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h5 class="text-primary">{{ $currentBusiness->name ?? 'ERP' }}</h5>
                        <small class="text-muted">{{ ucfirst($currentBusiness->type ?? '') }} Business</small>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') || request()->is('dashboard') ? 'active' : '' }}" 
                               href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        
                        @if($currentBusiness->type === 'construction' || $currentBusiness->type === 'interior')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('projects*') ? 'active' : '' }}" 
                               href="{{ route('projects.index') }}">
                                <i class="bi bi-building"></i> Projects
                            </a>
                        </li>
                        @endif
                        
                        @if($currentBusiness->type === 'construction')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('inventory*') ? 'active' : '' }}" 
                               href="#">
                                <i class="bi bi-box-seam"></i> Inventory
                            </a>
                        </li>
                        @endif
                        
                        @if($currentBusiness->type === 'upvc')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('leads*') ? 'active' : '' }}" 
                               href="#">
                                <i class="bi bi-person-plus"></i> Leads
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('quotations*') ? 'active' : '' }}" 
                               href="#">
                                <i class="bi bi-file-text"></i> Quotations
                            </a>
                        </li>
                        @endif
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('invoices*') ? 'active' : '' }}" 
                               href="#">
                                <i class="bi bi-file-earmark-text"></i> Invoices
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('expenses*') ? 'active' : '' }}" 
                               href="#">
                                <i class="bi bi-cash-stack"></i> Expenses
                            </a>
                        </li>
                    </ul>
                    
                    <hr>
                    
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" 
                           id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            <span class="ms-2">{{ $currentUser->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><span class="dropdown-item-text"><small class="text-muted">{{ ucfirst($currentUser->role) }}</small></span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="bi bi-box-arrow-right"></i> Sign out
                            </a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('header', 'Dashboard')</h1>
                    @yield('actions')
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    @else
    @yield('content')
    @endif
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>

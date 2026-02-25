@extends('layouts.unified')

@section('title', 'Dropdown Test - Multi-Business ERP')

@section('page-title', 'Dropdown Test')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Dropdown Testing</h6>
            </div>
            <div class="card-body">
                <h5>Business Type Switching Test</h5>
                <p>Current Business Type: <strong>{{ session('business_type', 'construction') }}</strong></p>
                
                <div class="mt-3">
                    <h6>Test Dropdown Button:</h6>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="testDropdown" data-bs-toggle="dropdown">
                            <i class="bi bi-gear me-2"></i> Test Dropdown
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="testDropdown">
                            <li><a class="dropdown-item" href="?business_type=construction">Construction</a></li>
                            <li><a class="dropdown-item" href="?business_type=sales">Sales</a></li>
                            <li><a class="dropdown-item" href="?business_type=design">Design</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="mt-3">
                    <h6>Business Type Selector:</h6>
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
                </div>
                
                <div class="mt-3">
                    <h6>Debug Information:</h6>
                    <ul class="list-group">
                        <li class="list-group-item">Session ID: {{ session()->getId() }}</li>
                        <li class="list-group-item">Business Type: {{ session('business_type', 'construction') }}</li>
                        <li class="list-group-item">Request URL: {{ request()->fullUrl() }}</li>
                        <li class="list-group-item">Business Type Parameter: {{ request()->get('business_type', 'none') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    console.log('Dropdown test page loaded');
    
    // Test dropdown functionality
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded for dropdown test');
        
        // Test the business type selector
        var businessSelector = document.querySelector('.business-selector');
        if (businessSelector) {
            console.log('Business selector found:', businessSelector);
            
            businessSelector.addEventListener('click', function(e) {
                console.log('Business selector clicked!');
                e.preventDefault();
                e.stopPropagation();
                
                // Toggle dropdown manually
                var dropdownMenu = businessSelector.nextElementSibling;
                if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')) {
                    console.log('Toggling dropdown menu');
                    dropdownMenu.classList.toggle('show');
                }
            });
        }
        
        // Test the test dropdown
        var testDropdown = document.querySelector('#testDropdown');
        if (testDropdown) {
            console.log('Test dropdown found:', testDropdown);
            
            testDropdown.addEventListener('click', function(e) {
                console.log('Test dropdown clicked!');
                e.preventDefault();
                e.stopPropagation();
                
                // Toggle dropdown manually
                var dropdownMenu = testDropdown.nextElementSibling;
                if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')) {
                    console.log('Toggling test dropdown menu');
                    dropdownMenu.classList.toggle('show');
                }
            });
        }
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                    menu.classList.remove('show');
                    console.log('Closing dropdown menu');
                });
            }
        });
    });
</script>
@endsection

@extends('layouts.unified')

@section('title', 'Reports - Multi-Business ERP')

@section('page-title', 'Reports')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reports Dashboard</h6>
            </div>
            <div class="card-body">
                <!-- Business Type Reports -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    {{ ucfirst($businessType ?? 'Construction') }} Reports
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @if($businessType === 'construction')
                                        Construction Management
                                    @elseif($businessType === 'sales')
                                        Sales Management
                                    @elseif($businessType === 'design')
                                        Design Management
                                    @else
                                        Business Management
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Available Reports
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    6 Reports
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Last Generated
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Today
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Report Categories -->
                <div class="row">
                    <div class="col-12">
                        <h5 class="mb-3">Available Reports</h5>
                    </div>
                </div>

                <div class="row">
                    <!-- Financial Reports -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Financial Reports</h6>
                                <i class="bi bi-cash-stack fa-2x text-gray-300"></i>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Revenue Summary</span>
                                        <button class="btn btn-sm btn-outline-primary">Generate</button>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Expense Report</span>
                                        <button class="btn btn-sm btn-outline-primary">Generate</button>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Profit & Loss</span>
                                        <button class="btn btn-sm btn-outline-primary">Generate</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Project Reports -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-success">Project Reports</h6>
                                <i class="bi bi-building fa-2x text-gray-300"></i>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Project Status</span>
                                        <button class="btn btn-sm btn-outline-success">Generate</button>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Timeline Analysis</span>
                                        <button class="btn btn-sm btn-outline-success">Generate</button>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Budget vs Actual</span>
                                        <button class="btn btn-sm btn-outline-success">Generate</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Sales Reports (Sales Business Only) -->
                    @if($businessType === 'sales')
                    <div class="col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-info">Sales Reports</h6>
                                <i class="bi bi-graph-up fa-2x text-gray-300"></i>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Lead Conversion</span>
                                        <button class="btn btn-sm btn-outline-info">Generate</button>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Sales Pipeline</span>
                                        <button class="btn btn-sm btn-outline-info">Generate</button>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Quotation Analysis</span>
                                        <button class="btn btn-sm btn-outline-info">Generate</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Inventory Reports (Construction Business Only) -->
                    @if($businessType === 'construction')
                    <div class="col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-warning">Inventory Reports</h6>
                                <i class="bi bi-box-seam fa-2x text-gray-300"></i>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Stock Summary</span>
                                        <button class="btn btn-sm btn-outline-warning">Generate</button>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Material Usage</span>
                                        <button class="btn btn-sm btn-outline-warning">Generate</button>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Inventory Valuation</span>
                                        <button class="btn btn-sm btn-outline-warning">Generate</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Client Reports -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-danger">Client Reports</h6>
                                <i class="bi bi-people fa-2x text-gray-300"></i>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Client Portfolio</span>
                                        <button class="btn btn-sm btn-outline-danger">Generate</button>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Payment History</span>
                                        <button class="btn btn-sm btn-outline-danger">Generate</button>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Client Satisfaction</span>
                                        <button class="btn btn-sm btn-outline-danger">Generate</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Quick Statistics</h6>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <div class="border-end">
                                            <h4 class="text-primary">24</h4>
                                            <p class="text-muted">Reports Generated</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="border-end">
                                            <h4 class="text-success">18</h4>
                                            <p class="text-muted">This Month</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="border-end">
                                            <h4 class="text-info">6</h4>
                                            <p class="text-muted">Report Types</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <h4 class="text-warning">100%</h4>
                                        <p class="text-muted">Accuracy</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

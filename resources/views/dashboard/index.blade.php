@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="row">
    <!-- KPI Cards -->
    @if($currentBusiness->type === 'construction')
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Projects
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['total_projects'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-building fa-2x text-gray-300"></i>
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
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Inventory Value
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($data['total_inventory_value'], 2) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-box-seam fa-2x text-gray-300"></i>
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
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Expenses
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($data['total_expenses'], 2) }}</div>
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
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Simple Profit
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($data['simple_profit'], 2) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-graph-up fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($currentBusiness->type === 'upvc')
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Leads
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['total_leads'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-person-plus fa-2x text-gray-300"></i>
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
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Converted Leads
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['converted_leads'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-check-circle fa-2x text-gray-300"></i>
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
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Quotations
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['total_quotations'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-file-text fa-2x text-gray-300"></i>
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
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Sales
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($data['total_sales'], 2) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-currency-dollar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($currentBusiness->type === 'interior')
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Active Projects
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['active_projects'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-building fa-2x text-gray-300"></i>
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
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Revenue
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($data['total_revenue'], 2) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-graph-up fa-2x text-gray-300"></i>
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
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Expenses
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($data['total_expenses'], 2) }}</div>
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
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Margin %
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($data['margin_percentage'], 1) }}%</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-percent fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Chart -->
<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    @if($currentBusiness->type === 'construction' || $currentBusiness->type === 'interior')
                        Projects by Status
                    @else
                        Leads by Status
                    @endif
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                @if($currentBusiness->type === 'construction' || $currentBusiness->type === 'interior')
                <a href="{{ route('projects.create') }}" class="btn btn-primary btn-block mb-2">
                    <i class="bi bi-plus-circle me-2"></i>New Project
                </a>
                @endif
                
                @if($currentBusiness->type === 'construction')
                <a href="{{ route('inventory.create') }}" class="btn btn-success btn-block mb-2">
                    <i class="bi bi-plus-circle me-2"></i>Add Inventory
                </a>
                @endif
                
                @if($currentBusiness->type === 'upvc')
                <a href="{{ route('leads.create') }}" class="btn btn-info btn-block mb-2">
                    <i class="bi bi-plus-circle me-2"></i>New Lead
                </a>
                <a href="{{ route('quotations.create') }}" class="btn btn-warning btn-block mb-2">
                    <i class="bi bi-plus-circle me-2"></i>New Quotation
                </a>
                @endif
                
                <a href="{{ route('invoices.create') }}" class="btn btn-secondary btn-block mb-2">
                    <i class="bi bi-plus-circle me-2"></i>New Invoice
                </a>
                
                <a href="{{ route('expenses.create') }}" class="btn btn-danger btn-block">
                    <i class="bi bi-plus-circle me-2"></i>Add Expense
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('statusChart').getContext('2d');
    
    @if($currentBusiness->type === 'construction' || $currentBusiness->type === 'interior')
        const data = @json($data['projects_by_status']);
        const labels = data.map(item => item.status);
        const values = data.map(item => item.count);
        const chartLabel = 'Projects';
    @else
        const data = @json($data['leads_by_status']);
        const labels = data.map(item => item.status);
        const values = data.map(item => item.count);
        const chartLabel = 'Leads';
    @endif
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: chartLabel,
                data: values,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>
@endpush

@push('styles')
<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
.text-xs {
    font-size: 0.7rem;
}
.chart-area {
    position: relative;
    height: 20rem;
    width: 100%;
}
</style>
@endpush

<?php

use App\Http\Controllers\UnifiedDashboardController;
use App\Http\Controllers\UnifiedProjectsController;
use App\Http\Controllers\UnifiedInventoryController;
use App\Http\Controllers\UnifiedLeadsController;
use App\Http\Controllers\UnifiedQuotationsController;
use App\Http\Controllers\UnifiedInvoicesController;
use App\Http\Controllers\UnifiedExpensesController;
use App\Http\Controllers\DemoController;
use App\Http\Middleware\BusinessTypeMiddleware;
use Illuminate\Support\Facades\Route;

// Test route without any middleware
Route::get('/test-login', [DemoController::class, 'login'])->name('test.login');
Route::post('/test-login', [DemoController::class, 'authenticate'])->name('test.login.post');

// Simple login route without any middleware
Route::get('/login', [DemoController::class, 'login'])->name('login');
Route::post('/login', [DemoController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [DemoController::class, 'logout'])->name('logout');

// Unified Multi-Business ERP Routes
Route::middleware(['web', BusinessTypeMiddleware::class])->group(function () {
    
    // Main Dashboard - Root route redirects to dashboard
    Route::get('/', function () {
        return redirect()->route('dashboard.index');
    })->name('dashboard');
    
    Route::get('/dashboard', [UnifiedDashboardController::class, 'index'])->name('dashboard.index');
    
    // Projects (All Business Types)
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [UnifiedProjectsController::class, 'index'])->name('index');
        Route::get('/create', [UnifiedProjectsController::class, 'create'])->name('create');
        Route::post('/', [UnifiedProjectsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UnifiedProjectsController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UnifiedProjectsController::class, 'update'])->name('update');
        Route::delete('/{id}', [UnifiedProjectsController::class, 'destroy'])->name('destroy');
    });
    
    // Inventory (Construction Business Only)
    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::get('/', [UnifiedInventoryController::class, 'index'])->name('index');
        Route::get('/create', [UnifiedInventoryController::class, 'create'])->name('create');
        Route::post('/', [UnifiedInventoryController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UnifiedInventoryController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UnifiedInventoryController::class, 'update'])->name('update');
        Route::delete('/{id}', [UnifiedInventoryController::class, 'destroy'])->name('destroy');
    });
    
    // Leads (Sales Business Only)
    Route::prefix('leads')->name('leads.')->group(function () {
        Route::get('/', [UnifiedLeadsController::class, 'index'])->name('index');
        Route::get('/create', [UnifiedLeadsController::class, 'create'])->name('create');
        Route::post('/', [UnifiedLeadsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UnifiedLeadsController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UnifiedLeadsController::class, 'update'])->name('update');
        Route::delete('/{id}', [UnifiedLeadsController::class, 'destroy'])->name('destroy');
    });
    
    // Quotations (Sales Business Only)
    Route::prefix('quotations')->name('quotations.')->group(function () {
        Route::get('/', [UnifiedQuotationsController::class, 'index'])->name('index');
        Route::get('/create', [UnifiedQuotationsController::class, 'create'])->name('create');
        Route::post('/', [UnifiedQuotationsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UnifiedQuotationsController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UnifiedQuotationsController::class, 'update'])->name('update');
        Route::delete('/{id}', [UnifiedQuotationsController::class, 'destroy'])->name('destroy');
    });
    
    // Invoices (All Business Types)
    Route::prefix('invoices')->name('invoices.')->group(function () {
        Route::get('/', [UnifiedInvoicesController::class, 'index'])->name('index');
        Route::get('/create', [UnifiedInvoicesController::class, 'create'])->name('create');
        Route::post('/', [UnifiedInvoicesController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UnifiedInvoicesController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UnifiedInvoicesController::class, 'update'])->name('update');
        Route::delete('/{id}', [UnifiedInvoicesController::class, 'destroy'])->name('destroy');
    });
    
    // Expenses (Construction & Design Business)
    Route::prefix('expenses')->name('expenses.')->group(function () {
        Route::get('/', [UnifiedExpensesController::class, 'index'])->name('index');
        Route::get('/create', [UnifiedExpensesController::class, 'create'])->name('create');
        Route::post('/', [UnifiedExpensesController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UnifiedExpensesController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UnifiedExpensesController::class, 'update'])->name('update');
        Route::delete('/{id}', [UnifiedExpensesController::class, 'destroy'])->name('destroy');
    });
    
    // Reports
    Route::get('/reports', function () {
        return view('reports.unified', ['businessType' => session('business_type', 'construction')]);
    })->name('reports.index');
    
    // Test page for dropdown
    Route::get('/test-dropdown', function () {
        return view('test.dropdown');
    })->name('test.dropdown');
});

// Demo routes for subdomains (no database required) - Keep for backward compatibility
Route::domain('{subdomain}.localhost')->group(function () {
    
    // Dashboard
    Route::get('/', [DemoController::class, 'dashboard'])->name('demo.dashboard');
    Route::get('/dashboard', [DemoController::class, 'dashboard'])->name('demo.dashboard.index');
    
    // Projects (Construction & Interior)
    Route::get('/projects', [DemoController::class, 'projects'])->name('demo.projects.index');
    
    // Other modules would go here with demo implementations
    
    // Dashboard API endpoints for charts
    Route::get('/api/dashboard/stats', [DemoController::class, 'dashboard'])->name('demo.dashboard.stats');
});

// End of routes

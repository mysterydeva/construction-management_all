<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

// Test route without any middleware
Route::get('/test-login', [DemoController::class, 'login'])->name('test.login');
Route::post('/test-login', [DemoController::class, 'authenticate'])->name('test.login.post');

// Simple login route without any middleware
Route::get('/login', [DemoController::class, 'login'])->name('login');
Route::post('/login', [DemoController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [DemoController::class, 'logout'])->name('logout');

// Demo routes for subdomains (no database required)
Route::domain('{subdomain}.localhost')->group(function () {
    
    // Dashboard
    Route::get('/', [DemoController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [DemoController::class, 'dashboard'])->name('dashboard.index');
    
    // Projects (Construction & Interior)
    Route::get('/projects', [DemoController::class, 'projects'])->name('projects.index');
    
    // Other modules would go here with demo implementations
    
    // Dashboard API endpoints for charts
    Route::get('/api/dashboard/stats', [DemoController::class, 'dashboard'])->name('dashboard.stats');
});

// Fallback route
Route::get('/', function () {
    return redirect('http://construction.localhost');
});

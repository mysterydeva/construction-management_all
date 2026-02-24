<?php

use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;

// These routes bypass all middleware
Route::get('/simple-login', [DemoController::class, 'login']);
Route::post('/simple-login', [DemoController::class, 'authenticate']);

// Direct dashboard access (no auth required)
Route::get('/simple-dashboard', [DemoController::class, 'dashboard']);

// Test route to verify controller works
Route::get('/test-controller', function () {
    return response()->json(['status' => 'Controller working', 'timestamp' => now()]);
});

// Dashboard without authentication check
Route::get('/demo-dashboard', function () {
    $business = (object) [
        'name' => 'BuildRight Construction',
        'type' => 'construction'
    ];
    
    // Share variables with view
    view()->share('currentUser', (object) [
        'name' => 'John Constructor',
        'email' => 'admin@construction.local',
        'role' => 'admin'
    ]);
    view()->share('currentBusiness', $business);
    
    return view('dashboard.index', [
        'data' => [
            'total_projects' => 3,
            'total_inventory_value' => 485000.00,
            'total_expenses' => 585000.00,
            'simple_profit' => 3820000.00,
            'projects_by_status' => [
                ['status' => 'completed', 'count' => 1],
                ['status' => 'active', 'count' => 1],
                ['status' => 'planning', 'count' => 1],
            ]
        ],
        'business' => $business
    ]);
});

// UPVC Dashboard
Route::get('/demo-upvc', function () {
    $business = (object) [
        'name' => 'UPVC Windows & Doors',
        'type' => 'upvc'
    ];
    
    view()->share('currentUser', (object) [
        'name' => 'Alex UPVC Admin',
        'email' => 'admin@upvc.local',
        'role' => 'admin'
    ]);
    view()->share('currentBusiness', $business);
    
    return view('dashboard.index', [
        'data' => [
            'total_leads' => 10,
            'converted_leads' => 3,
            'total_quotations' => 4,
            'total_sales' => 153400.00,
            'leads_by_status' => [
                ['status' => 'new', 'count' => 2],
                ['status' => 'contacted', 'count' => 2],
                ['status' => 'qualified', 'count' => 2],
                ['status' => 'converted', 'count' => 3],
                ['status' => 'lost', 'count' => 1],
            ]
        ],
        'business' => $business
    ]);
});

// Interior Dashboard
Route::get('/demo-interior', function () {
    $business = (object) [
        'name' => 'Elegant Interior Designs',
        'type' => 'interior'
    ];
    
    view()->share('currentUser', (object) [
        'name' => 'Emma Interior Admin',
        'email' => 'admin@interior.local',
        'role' => 'admin'
    ]);
    view()->share('currentBusiness', $business);
    
    return view('dashboard.index', [
        'data' => [
            'active_projects' => 1,
            'total_revenue' => 1168200.00,
            'total_expenses' => 20500.00,
            'margin_percentage' => 98.2,
            'projects_by_status' => [
                ['status' => 'completed', 'count' => 1],
                ['status' => 'active', 'count' => 1],
            ]
        ],
        'business' => $business
    ]);
});

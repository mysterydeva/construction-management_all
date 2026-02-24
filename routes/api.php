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

// Add missing routes for dashboard
Route::get('/projects/create', function () {
    return response()->json(['message' => 'Projects create form']);
});
Route::post('/projects', function () {
    return response()->json(['message' => 'Project stored']);
});
Route::get('/inventory/create', function () {
    return response()->json(['message' => 'Inventory create form']);
});
Route::post('/inventory', function () {
    return response()->json(['message' => 'Inventory stored']);
});
Route::get('/leads/create', function () {
    return response()->json(['message' => 'Leads create form']);
});
Route::post('/leads', function () {
    return response()->json(['message' => 'Lead stored']);
});
Route::get('/quotations/create', function () {
    return response()->json(['message' => 'Quotations create form']);
});
Route::post('/quotations', function () {
    return response()->json(['message' => 'Quotation stored']);
});
Route::get('/invoices/create', function () {
    return response()->json(['message' => 'Invoices create form']);
});
Route::post('/invoices', function () {
    return response()->json(['message' => 'Invoice stored']);
});
Route::get('/expenses/create', function () {
    return response()->json(['message' => 'Expenses create form']);
});
Route::post('/expenses', function () {
    return response()->json(['message' => 'Expense stored']);
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
    
    return view('dashboard.modern', [
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
        'business' => $business,
        'recentActivity' => [
            [
                'title' => 'New project created',
                'time' => '2 hours ago',
                'icon' => 'bi-building',
                'color' => 'primary'
            ],
            [
                'title' => 'Invoice #1234 generated',
                'time' => '4 hours ago',
                'icon' => 'bi-file-earmark-text',
                'color' => 'success'
            ],
            [
                'title' => 'Payment received',
                'time' => '6 hours ago',
                'icon' => 'bi-cash',
                'color' => 'info'
            ],
            [
                'title' => 'New lead added',
                'time' => '1 day ago',
                'icon' => 'bi-person-plus',
                'color' => 'warning'
            ]
        ]
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
    
    return view('dashboard.modern', [
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
        'business' => $business,
        'recentActivity' => [
            [
                'title' => 'New lead converted',
                'time' => '1 hour ago',
                'icon' => 'bi-person-check',
                'color' => 'success'
            ],
            [
                'title' => 'Quotation sent to client',
                'time' => '3 hours ago',
                'icon' => 'bi-file-text',
                'color' => 'info'
            ],
            [
                'title' => 'New lead from website',
                'time' => '5 hours ago',
                'icon' => 'bi-person-plus',
                'color' => 'primary'
            ],
            [
                'title' => 'Follow-up scheduled',
                'time' => '1 day ago',
                'icon' => 'bi-calendar',
                'color' => 'warning'
            ]
        ]
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
    
    return view('dashboard.modern', [
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
        'business' => $business,
        'recentActivity' => [
            [
                'title' => 'Design approved by client',
                'time' => '2 hours ago',
                'icon' => 'bi-check-circle',
                'color' => 'success'
            ],
            [
                'title' => 'New project proposal sent',
                'time' => '4 hours ago',
                'icon' => 'bi-building',
                'color' => 'primary'
            ],
            [
                'title' => 'Material order placed',
                'time' => '6 hours ago',
                'icon' => 'bi-box-seam',
                'color' => 'info'
            ],
            [
                'title' => 'Client meeting scheduled',
                'time' => '1 day ago',
                'icon' => 'bi-calendar',
                'color' => 'warning'
            ]
        ]
    ]);
});

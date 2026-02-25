<?php

// Simple Vercel serverless entry point
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Set required server variables for Vercel
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';

// Handle Vercel forwarded headers
if (isset($_SERVER['HTTP_X_VERCEL_FORWARDED_HOST'])) {
    $_SERVER['HTTP_HOST'] = $_SERVER['HTTP_X_VERCEL_FORWARDED_HOST'];
    $_SERVER['HTTPS'] = 'on';
}

// Set APP_URL dynamically
$appUrl = 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost');
$_ENV['APP_URL'] = $appUrl;

// Configure Laravel for Vercel read-only environment
$_ENV['APP_ENV'] = 'production';
$_ENV['APP_DEBUG'] = 'false';
$_ENV['APP_KEY'] = 'base64:iSg0UaHPigja2vpubkQgEHEIbWJmIF8lv1Ba2rC5VkM=';
$_ENV['CACHE_DRIVER'] = 'array';
$_ENV['SESSION_DRIVER'] = 'array';
$_ENV['QUEUE_CONNECTION'] = 'sync';
$_ENV['LOG_CHANNEL'] = 'errorlog';
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
$_ENV['APP_STORAGE_PATH'] = '/tmp/storage';

// Create temporary directories if they don't exist
if (!is_dir('/tmp')) {
    mkdir('/tmp', 0755, true);
}
if (!is_dir('/tmp/storage')) {
    mkdir('/tmp/storage', 0755, true);
}
if (!is_dir('/tmp/storage/framework')) {
    mkdir('/tmp/storage/framework', 0755, true);
}
if (!is_dir('/tmp/storage/framework/views')) {
    mkdir('/tmp/storage/framework/views', 0755, true);
}

// Simple routing for the ERP system
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Parse the request URI
$path = parse_url($requestUri, PHP_URL_PATH);
$path = str_replace('/index.php', '', $path);

// Route handling
switch ($path) {
    case '/':
    case '/dashboard':
        // Serve the dashboard
        serveDashboard();
        break;
    case '/projects':
        serveProjects();
        break;
    case '/inventory':
        serveInventory();
        break;
    case '/leads':
        serveLeads();
        break;
    case '/quotations':
        serveQuotations();
        break;
    case '/invoices':
        serveInvoices();
        break;
    case '/expenses':
        serveExpenses();
        break;
    case '/reports':
        serveReports();
        break;
    default:
        // 404 for unknown routes
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Page not found']);
        break;
}

// Simple response functions
function serveDashboard() {
    $businessType = $_GET['business_type'] ?? 'construction';
    $metrics = getDashboardMetrics($businessType);
    
    header('Content-Type: text/html');
    echo generateDashboardHTML($businessType, $metrics);
}

function serveProjects() {
    $businessType = $_GET['business_type'] ?? 'construction';
    $projects = getProjectsData($businessType);
    
    header('Content-Type: text/html');
    echo generateProjectsHTML($businessType, $projects);
}

function serveInventory() {
    $businessType = $_GET['business_type'] ?? 'construction';
    $inventory = getInventoryData($businessType);
    
    header('Content-Type: text/html');
    echo generateInventoryHTML($businessType, $inventory);
}

function serveLeads() {
    $businessType = $_GET['business_type'] ?? 'construction';
    $leads = getLeadsData($businessType);
    
    header('Content-Type: text/html');
    echo generateLeadsHTML($businessType, $leads);
}

function serveQuotations() {
    $businessType = $_GET['business_type'] ?? 'construction';
    $quotations = getQuotationsData($businessType);
    
    header('Content-Type: text/html');
    echo generateQuotationsHTML($businessType, $quotations);
}

function serveInvoices() {
    $businessType = $_GET['business_type'] ?? 'construction';
    $invoices = getInvoicesData($businessType);
    
    header('Content-Type: text/html');
    echo generateInvoicesHTML($businessType, $invoices);
}

function serveExpenses() {
    $businessType = $_GET['business_type'] ?? 'construction';
    $expenses = getExpensesData($businessType);
    
    header('Content-Type: text/html');
    echo generateExpensesHTML($businessType, $expenses);
}

function serveReports() {
    $businessType = $_GET['business_type'] ?? 'construction';
    
    header('Content-Type: text/html');
    echo generateReportsHTML($businessType);
}

// Data provider functions (simplified versions)
function getDashboardMetrics($businessType) {
    return [
        'construction' => [
            'total_projects' => 3,
            'active_projects' => 2,
            'inventory_value' => 150000,
            'total_expenses' => 45000,
        ],
        'sales' => [
            'total_leads' => 6,
            'qualified_leads' => 4,
            'sales_revenue' => 250000,
        ],
        'design' => [
            'active_projects' => 4,
            'total_revenue' => 300000,
            'completed_projects' => 3,
        ],
    ][$businessType] ?? [
        'total_projects' => 0,
        'active_projects' => 0,
        'inventory_value' => 0,
        'total_expenses' => 0,
    ];
}

function getProjectsData($businessType) {
    return [
        'construction' => [
            ['id' => 1, 'client' => 'ABC Builders', 'estimated' => 500000, 'actual' => 450000, 'status' => 'Completed'],
            ['id' => 2, 'client' => 'Sunrise Infra', 'estimated' => 800000, 'actual' => 820000, 'status' => 'Ongoing'],
        ],
        'sales' => [],
        'design' => [
            ['id' => 1, 'client' => 'Luxury Homes', 'revenue' => 300000, 'expense' => 200000, 'status' => 'Completed'],
        ],
    ][$businessType] ?? [];
}

function getInventoryData($businessType) {
    return [
        'construction' => [
            ['item' => 'Cement', 'qty' => 200, 'price' => 350],
            ['item' => 'Steel', 'qty' => 100, 'price' => 600],
        ],
    ][$businessType] ?? [];
}

function getLeadsData($businessType) {
    return [
        'sales' => [
            ['id' => 1, 'name' => 'Ramesh', 'status' => 'New'],
            ['id' => 2, 'name' => 'Suresh', 'status' => 'Converted'],
        ],
    ][$businessType] ?? [];
}

function getQuotationsData($businessType) {
    return [
        'sales' => [
            ['id' => 1, 'customer' => 'Ramesh', 'amount' => 150000, 'status' => 'Approved'],
        ],
    ][$businessType] ?? [];
}

function getInvoicesData($businessType) {
    return [
        'construction' => [
            ['id' => 1, 'client' => 'ABC Builders', 'amount' => 450000, 'status' => 'Paid'],
        ],
        'sales' => [
            ['id' => 1, 'customer' => 'Ramesh', 'amount' => 150000, 'status' => 'Paid'],
        ],
        'design' => [
            ['id' => 1, 'client' => 'Luxury Homes', 'amount' => 300000, 'status' => 'Paid'],
        ],
    ][$businessType] ?? [];
}

function getExpensesData($businessType) {
    return [
        'construction' => [
            ['id' => 1, 'description' => 'Materials', 'amount' => 25000, 'date' => '2024-01-15'],
        ],
        'design' => [
            ['id' => 1, 'description' => 'Design Software', 'amount' => 5000, 'date' => '2024-01-20'],
        ],
    ][$businessType] ?? [];
}

// HTML generation functions (simplified)
function generateDashboardHTML($businessType, $metrics) {
    $businessName = ucfirst($businessType);
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Dashboard - Multi-Business ERP</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css' rel='stylesheet'>
    </head>
    <body>
        <div class='container mt-4'>
            <h1>Dashboard - {$businessName} Management</h1>
            <div class='row'>
                <div class='col-md-3'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5>Total Projects</h5>
                            <h3>{$metrics['total_projects']}</h3>
                        </div>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5>Active Projects</h5>
                            <h3>{$metrics['active_projects']}</h3>
                        </div>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5>Inventory Value</h5>
                            <h3>\${$metrics['inventory_value']}</h3>
                        </div>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5>Total Expenses</h5>
                            <h3>\${$metrics['total_expenses']}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>";
}

function generateProjectsHTML($businessType, $projects) {
    $businessName = ucfirst($businessType);
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Projects - Multi-Business ERP</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css' rel='stylesheet'>
    </head>
    <body>
        <div class='container mt-4'>
            <h1>Projects - {$businessName}</h1>
            <div class='table-responsive'>
                <table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Estimated</th>
                            <th>Actual</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>";
    
    foreach ($projects as $project) {
        echo "
                        <tr>
                            <td>{$project['id']}</td>
                            <td>{$project['client']}</td>
                            <td>\${$project['estimated']}</td>
                            <td>\${$project['actual']}</td>
                            <td>{$project['status']}</td>
                        </tr>";
    }
    
    echo "
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    </html>";
}

function generateInventoryHTML($businessType, $inventory) {
    $businessName = ucfirst($businessType);
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Inventory - Multi-Business ERP</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css' rel='stylesheet'>
    </head>
    <body>
        <div class='container mt-4'>
            <h1>Inventory - {$businessName}</h1>
            <div class='table-responsive'>
                <table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>";
    
    foreach ($inventory as $item) {
        echo "
                        <tr>
                            <td>{$item['item']}</td>
                            <td>{$item['qty']}</td>
                            <td>\${$item['price']}</td>
                        </tr>";
    }
    
    echo "
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    </html>";
}

function generateLeadsHTML($businessType, $leads) {
    $businessName = ucfirst($businessType);
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Leads - Multi-Business ERP</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css' rel='stylesheet'>
    </head>
    <body>
        <div class='container mt-4'>
            <h1>Leads - {$businessName}</h1>
            <div class='table-responsive'>
                <table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>";
    
    foreach ($leads as $lead) {
        echo "
                        <tr>
                            <td>{$lead['id']}</td>
                            <td>{$lead['name']}</td>
                            <td>{$lead['status']}</td>
                        </tr>";
    }
    
    echo "
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    </html>";
}

function generateQuotationsHTML($businessType, $quotations) {
    $businessName = ucfirst($businessType);
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Quotations - Multi-Business ERP</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css' rel='stylesheet'>
    </head>
    <body>
        <div class='container mt-4'>
            <h1>Quotations - {$businessName}</h1>
            <div class='table-responsive'>
                <table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>";
    
    foreach ($quotations as $quotation) {
        echo "
                        <tr>
                            <td>{$quotation['id']}</td>
                            <td>{$quotation['customer']}</td>
                            <td>\${$quotation['amount']}</td>
                            <td>{$quotation['status']}</td>
                        </tr>";
    }
    
    echo "
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    </html>";
}

function generateInvoicesHTML($businessType, $invoices) {
    $businessName = ucfirst($businessType);
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Invoices - Multi-Business ERP</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css' rel='stylesheet'>
    </head>
    <body>
        <div class='container mt-4'>
            <h1>Invoices - {$businessName}</h1>
            <div class='table-responsive'>
                <table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>";
    
    foreach ($invoices as $invoice) {
        echo "
                        <tr>
                            <td>{$invoice['id']}</td>
                            <td>{$invoice['client']}</td>
                            <td>\${$invoice['amount']}</td>
                            <td>{$invoice['status']}</td>
                        </tr>";
    }
    
    echo "
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    </html>";
}

function generateExpensesHTML($businessType, $expenses) {
    $businessName = ucfirst($businessType);
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Expenses - Multi-Business ERP</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css' rel='stylesheet'>
    </head>
    <body>
        <div class='container mt-4'>
            <h1>Expenses - {$businessName}</h1>
            <div class='table-responsive'>
                <table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>";
    
    foreach ($expenses as $expense) {
        echo "
                        <tr>
                            <td>{$expense['id']}</td>
                            <td>{$expense['description']}</td>
                            <td>\${$expense['amount']}</td>
                            <td>{$expense['date']}</td>
                        </tr>";
    }
    
    echo "
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    </html>";
}

function generateReportsHTML($businessType) {
    $businessName = ucfirst($businessType);
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Reports - Multi-Business ERP</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css' rel='stylesheet'>
    </head>
    <body>
        <div class='container mt-4'>
            <h1>Reports - {$businessName}</h1>
            <div class='alert alert-info'>
                <h4>Reports Dashboard</h4>
                <p>Comprehensive reporting and analytics for {$businessName} management.</p>
                <div class='row mt-3'>
                    <div class='col-md-4'>
                        <div class='card'>
                            <div class='card-body'>
                                <h5>Financial Reports</h5>
                                <p>Revenue, expenses, profit & loss</p>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='card'>
                            <div class='card-body'>
                                <h5>Project Reports</h5>
                                <p>Timeline, budget vs actual</p>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='card'>
                            <div class='card-body'>
                                <h5>Client Reports</h5>
                                <p>Portfolio, satisfaction metrics</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>";
}

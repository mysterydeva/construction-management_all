<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DemoController extends Controller
{
    public function dashboard(Request $request)
    {
        Log::info('Dashboard method called', [
            'host' => $request->getHost(),
            'method' => $request->method(),
            'session_has_user' => session()->has('user'),
            'session_data' => session()->all(),
            'headers' => $request->headers->all()
        ]);

        // Check if user is authenticated
        if (!session()->has('user')) {
            Log::warning('User not authenticated, redirecting to login');
            return redirect('/login');
        }

        Log::info('User authenticated, proceeding with dashboard', [
            'user' => session('user')
        ]);

        // Simulate business detection from subdomain
        $subdomain = explode('.', $request->getHost())[0] ?? 'construction';
        Log::info('Subdomain detected', ['subdomain' => $subdomain]);
        
        $businesses = [
            'construction' => [
                'name' => 'BuildRight Construction',
                'type' => 'construction',
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
                ]
            ],
            'upvc' => [
                'name' => 'UPVC Windows & Doors',
                'type' => 'upvc',
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
                ]
            ],
            'interior' => [
                'name' => 'Elegant Interior Designs',
                'type' => 'interior',
                'data' => [
                    'active_projects' => 1,
                    'total_revenue' => 1168200.00,
                    'total_expenses' => 20500.00,
                    'margin_percentage' => 98.2,
                    'projects_by_status' => [
                        ['status' => 'completed', 'count' => 1],
                        ['status' => 'active', 'count' => 1],
                    ]
                ]
            ]
        ];
        
        $business = (object) $businesses[$subdomain] ?? $businesses['construction'];
        $data = $business->data;
        
        Log::info('Business data prepared', [
            'business_name' => $business->name,
            'business_type' => $business->type,
            'data_keys' => array_keys($data)
        ]);
        
        // Share user data with all views
        view()->share('currentUser', (object) session('user'));
        view()->share('currentBusiness', $business);
        
        // Add recent activity data
        $recentActivity = [
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
        ];
        
        Log::info('Rendering dashboard view');
        return view('dashboard.modern', compact('data', 'business', 'recentActivity'));
    }
    
    public function login()
    {
        Log::info('Login page accessed', [
            'method' => request()->method(),
            'session_data' => session()->all(),
            'headers' => request()->headers->all()
        ]);
        
        return view('auth.login');
    }
    
    public function authenticate(Request $request)
    {
        Log::info('Authentication attempt started', [
            'request_method' => $request->method(),
            'request_data' => $request->all(),
            'headers' => $request->headers->all(),
            'session_before' => session()->all()
        ]);

        // Simple validation for demo
        $email = $request->input('email');
        $password = $request->input('password');

        Log::info('Simple validation', ['email' => $email, 'password_provided' => !empty($password)]);

        // Demo authentication - accept any email with password "password"
        if ($password === 'password' && !empty($email)) {
            Log::info('Password correct, creating session');
            
            // Store user info in session
            $userData = [
                'name' => $this->getUserName($email),
                'email' => $email,
                'role' => 'admin',
                'business' => $this->getUserBusiness($email)
            ];
            
            session(['user' => $userData]);
            
            Log::info('Session created', [
                'user_data' => $userData,
                'session_after' => session()->all()
            ]);

            // Redirect to appropriate subdomain
            $business = $this->getUserBusiness($email);
            $redirectUrl = "http://{$business}.localhost:8000/dashboard";
            
            Log::info('Redirecting to dashboard', ['redirect_url' => $redirectUrl]);
            
            return redirect($redirectUrl);
        }

        Log::warning('Authentication failed', ['email' => $email, 'password_provided' => !empty($password)]);

        // Create a simple error message
        $errorMessage = 'Invalid credentials. Please use password "password" with any business email.';
        
        return redirect('/login')->with('error', $errorMessage);
    }
    
    public function logout(Request $request)
    {
        Log::info('Logout requested', [
            'session_before' => session()->all()
        ]);
        
        session()->flush();
        
        Log::info('Session flushed, redirecting to login');
        
        return redirect('/login');
    }
    
    private function getUserName($email)
    {
        Log::info('Getting username for email', ['email' => $email]);
        
        $names = [
            'admin@construction.local' => 'John Constructor',
            'manager@construction.local' => 'Sarah Project Manager',
            'admin@upvc.local' => 'Alex UPVC Admin',
            'sales@upvc.local' => 'Lisa Sales Rep',
            'admin@interior.local' => 'Emma Interior Admin',
            'designer@interior.local' => 'David Interior Designer',
        ];
        
        $name = $names[$email] ?? 'Demo User';
        Log::info('Username determined', ['email' => $email, 'name' => $name]);
        
        return $name;
    }
    
    private function getUserBusiness($email)
    {
        Log::info('Getting business for email', ['email' => $email]);
        
        if (strpos($email, 'construction') !== false) {
            $business = 'construction';
        } elseif (strpos($email, 'upvc') !== false) {
            $business = 'upvc';
        } elseif (strpos($email, 'interior') !== false) {
            $business = 'interior';
        } else {
            $business = 'construction'; // default
        }
        
        Log::info('Business determined', ['email' => $email, 'business' => $business]);
        
        return $business;
    }
    
    public function projects()
    {
        Log::info('Projects page accessed', [
            'session_has_user' => session()->has('user'),
            'user' => session('user')
        ]);
        
        $projects = [
            (object) [
                'id' => 1,
                'project_name' => 'Commercial Complex Building',
                'client_name' => 'Mahesh Kumar',
                'estimated_cost' => 2500000.00,
                'actual_cost' => 2750000.00,
                'status' => 'completed'
            ],
            (object) [
                'id' => 2,
                'project_name' => 'Residential Villa',
                'client_name' => 'Priya Sharma',
                'estimated_cost' => 1800000.00,
                'actual_cost' => 1650000.00,
                'status' => 'active'
            ],
            (object) [
                'id' => 3,
                'project_name' => 'Warehouse Construction',
                'client_name' => 'Raj Enterprises',
                'estimated_cost' => 3200000.00,
                'actual_cost' => null,
                'status' => 'planning'
            ]
        ];
        
        return view('projects.index', ['projects' => new class($projects) {
            private $items;
            public function __construct($items) { $this->items = $items; }
            public function count() { return count($this->items); }
            public function get($key) { return $this->items[$key] ?? null; }
            public function links() { return ''; }
        }]);
    }
}

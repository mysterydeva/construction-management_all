<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\DemoController;

class DemoMode
{
    public function handle($request, Closure $next)
    {
        // Check if demo mode is enabled
        if (config('app.demo', false)) {
            // If not authenticated, auto-login based on subdomain
            if (!session()->has('user')) {
                $subdomain = explode('.', $request->getHost())[0] ?? 'construction';
                
                $adminUsers = [
                    'construction' => [
                        'name' => 'John Constructor',
                        'email' => 'admin@construction.local',
                        'role' => 'admin',
                        'business' => 'construction'
                    ],
                    'upvc' => [
                        'name' => 'Alex UPVC Admin',
                        'email' => 'admin@upvc.local',
                        'role' => 'admin',
                        'business' => 'upvc'
                    ],
                    'interior' => [
                        'name' => 'Emma Interior Admin',
                        'email' => 'admin@interior.local',
                        'role' => 'admin',
                        'business' => 'interior'
                    ]
                ];
                
                $userData = $adminUsers[$subdomain] ?? $adminUsers['construction'];
                session(['user' => $userData]);
            }
        }
        
        return $next($request);
    }
}

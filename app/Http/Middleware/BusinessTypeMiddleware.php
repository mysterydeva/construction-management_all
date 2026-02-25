<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class BusinessTypeMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        try {
            Log::info('BusinessTypeMiddleware: Handling request');
            
            // Set default business type if not set
            if (!Session::has('business_type')) {
                Session::put('business_type', 'construction');
                Log::info('BusinessTypeMiddleware: Set default business_type to construction');
            }

            // Handle business type switching from query parameter
            if ($request->has('business_type')) {
                $businessType = $request->get('business_type');
                Log::info('BusinessTypeMiddleware: Request to switch to: ' . $businessType);
                
                if (in_array($businessType, ['construction', 'sales', 'design'])) {
                    Session::put('business_type', $businessType);
                    Log::info('BusinessTypeMiddleware: Switched business_type to: ' . $businessType);
                    
                    // Flash message for user feedback
                    Session::flash('success', "Switched to " . ucfirst($businessType) . " Management");
                } else {
                    Log::warning('BusinessTypeMiddleware: Invalid business_type requested: ' . $businessType);
                }
            }
            
            Log::info('BusinessTypeMiddleware: Current business_type: ' . Session::get('business_type'));
            
            return $next($request);
            
        } catch (\Exception $e) {
            Log::error('BusinessTypeMiddleware error: ' . $e->getMessage());
            return $next($request);
        }
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\Business;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubdomainMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $subdomain = explode('.', $host)[0] ?? null;

        if ($subdomain && $subdomain !== 'www' && $subdomain !== 'localhost') {
            $business = Business::where('subdomain', $subdomain)->first();
            
            if ($business) {
                // Share business context with all views
                view()->share('currentBusiness', $business);
                
                // Add business to request for use in controllers
                $request->merge(['business_id' => $business->id]);
                $request->attributes->set('business', $business);
                
                // Store in session for easy access
                session(['current_business_id' => $business->id]);
                session(['current_business_type' => $business->type]);
            } else {
                // Redirect to main domain if subdomain not found
                return redirect('http://localhost');
            }
        } else {
            // No subdomain, redirect to a default business or show landing page
            return redirect('http://construction.localhost');
        }

        return $next($request);
    }
}

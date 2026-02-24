<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SkipCsrfForLogin extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Log::info('CSRF Middleware Check', [
            'request_path' => $request->path(),
            'request_method' => $request->method(),
            'is_login' => $request->is('login') || $request->is('login.post'),
            'all_headers' => $request->headers->all()
        ]);

        // Skip CSRF verification for login routes
        if ($request->is('login') || $request->is('login.post')) {
            Log::info('CSRF skipped for login route');
            return $next($request);
        }

        Log::info('CSRF verification proceeding');
        return parent::handle($request, $next);
    }
}

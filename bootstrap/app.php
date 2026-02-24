<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/routes/console.php',
        health: '/up',
        api: __DIR__.'/routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Replace CSRF middleware with custom one that does nothing
        $middleware->replace(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class, \App\Http\Middleware\DisableCsrf::class);
        
        // Add Demo Mode middleware for auto-login
        $middleware->web(append: [
            \App\Http\Middleware\DemoMode::class,
        ]);
        
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

<?php

// Vercel serverless entry point for Laravel
require __DIR__ . '/../vendor/autoload.php';

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

// Bootstrap Laravel application
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Handle the HTTP request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Send the response
$response->send();

// Terminate the request
$kernel->terminate($request, $response);

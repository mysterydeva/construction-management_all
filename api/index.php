<?php

// Vercel serverless environment setup
use Illuminate\Http\Request;

// Set required server variables for Laravel
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';

// Handle forwarded host from Vercel
if (isset($_SERVER['HTTP_X_VERCEL_FORWARDED_HOST'])) {
    $_SERVER['HTTP_HOST'] = $_SERVER['HTTP_X_VERCEL_FORWARDED_HOST'];
    $_SERVER['HTTPS'] = 'on';
}

// Set proper request URI
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$_SERVER['REQUEST_URI'] = $requestUri;

// Bootstrap Laravel
require __DIR__ . '/../vendor/autoload.php';

// Create Laravel application
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Handle the request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);

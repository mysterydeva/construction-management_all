<?php

// Simple Vercel serverless entry point for Laravel
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

// Try to load Laravel with error handling
try {
    require __DIR__ . '/../public/index.php';
} catch (Exception $e) {
    // Return error response for debugging
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'error' => 'Laravel bootstrap failed',
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString()
    ]);
} catch (Error $e) {
    // Return error response for debugging
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'error' => 'Laravel bootstrap error',
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString()
    ]);
}

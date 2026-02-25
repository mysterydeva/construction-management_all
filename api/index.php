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
        'line' => $e->getLine()
    ]);
} catch (Error $e) {
    // Return error response for debugging
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'error' => 'Laravel bootstrap error',
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
}

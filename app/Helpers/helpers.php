<?php

use Illuminate\Support\Str;

if (!function_exists('urlWithQuery')) {
    /**
     * Add query parameters to current URL.
     */
    function urlWithQuery(array $params): string
    {
        $url = request()->url();
        $query = request()->query();
        
        // Merge new parameters with existing ones
        $mergedParams = array_merge($query, $params);
        
        // Remove empty parameters
        $mergedParams = array_filter($mergedParams, function($value) {
            return $value !== '' && $value !== null;
        });
        
        return $url . (empty($mergedParams) ? '' : '?' . http_build_query($mergedParams));
    }
}

if (!function_exists('__')) {
    /**
     * Translation helper for business types.
     */
    function __(string $key): string
    {
        $translations = [
            'business_types.construction' => 'Construction Management',
            'business_types.sales' => 'Sales & Lead Management',
            'business_types.design' => 'Design Project Management',
        ];
        
        return $translations[$key] ?? $key;
    }
}

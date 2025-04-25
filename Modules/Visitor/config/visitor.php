<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Visitor Tracking Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains configuration options for the Visitor module.
    |
    */

    // Whether to track visitors by default
    'enabled' => env('VISITOR_TRACKING_ENABLED', true),
    
    // IPs that should be excluded from tracking
    'excluded_ips' => [
        '127.0.0.1',
        '::1',
        // Add more IPs here
    ],
    
    // User agent strings that should be excluded (bots, crawlers, etc.)
    'excluded_user_agents' => [
        'bot',
        'crawl',
        'spider',
        'slurp',
        'baiduspider',
        'yandex',
        'mediapartners-google',
        'googlebot',
        'bingbot',
        // Add more patterns here
    ],
    
    // Whether to use IP geolocation
    'enable_geolocation' => true,
    
    // Geolocation service (options: 'ipinfo', 'maxmind', 'ipapi')
    'geolocation_service' => 'ipapi',
    
    // API keys for geolocation services
    'geolocation_api_keys' => [
        'ipinfo' => env('IPINFO_API_KEY'),
        'maxmind' => env('MAXMIND_API_KEY'),
        'ipapi' => null, // No API key needed for free tier
    ],
    
    // Session timeout in minutes
    'session_timeout' => 30,
    
    // Time threshold in seconds to consider a bounce
    'bounce_threshold' => 30,
    
    // Routes to exclude from tracking
    'excluded_routes' => [
        'admin.*',
        'api.visitor.*',
        // Add more route patterns here
    ],
    
    // Whether to track UTM parameters
    'track_utm' => true,
    
    // Whether to track events
    'track_events' => true,
    
    // Event types to track
    'tracked_event_types' => [
        'click',
        'scroll',
        'form_submission',
        'file_download',
        'video_play',
        'video_pause',
        'video_complete',
        'error',
        // Add more event types here
    ],
    
    // Data retention period in days (0 = keep forever)
    'data_retention_days' => [
        'visitors' => 365, // Keep visitor data for 1 year
        'sessions' => 180, // Keep session data for 6 months
        'page_views' => 90, // Keep page views for 3 months
        'events' => 90, // Keep events for 3 months
        'metrics' => 0, // Keep aggregated metrics forever
    ],
    
    // Whether to anonymize IP addresses
    'anonymize_ip' => true,
    
    // Whether to track device information
    'track_device_info' => true,
]; 
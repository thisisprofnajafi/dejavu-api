# Visitor Module

A comprehensive visitor tracking and analytics module for the DejaVu API project, enabling detailed visitor analytics, session tracking, and event monitoring.

## Features

- Anonymous visitor tracking
- Session management
- Page view tracking
- Event tracking
- Comprehensive metrics collection
- Geographic location tracking
- UTM parameter tracking
- Device and browser detection
- Bounce rate calculation
- Time on page metrics

## Installation

1. Make sure the module is enabled in your `modules.json` file.
2. Run migrations:
   ```
   php artisan module:migrate Visitor
   ```
3. Publish configuration (optional):
   ```
   php artisan vendor:publish --provider="Modules\Visitor\Providers\VisitorServiceProvider" --tag="config"
   ```

## Components

### Visitor

The core model for tracking anonymous visitors.

- IP address and user agent tracking
- Geographic location (country, city)
- Browser and device information
- UTM parameters for campaign tracking
- Language preference

### VisitorSession

Track user sessions with detailed information.

- Entry and exit pages
- Session duration
- Page view count
- Bounce rate tracking
- Device information

### PageView

Record detailed information about page visits.

- URL and page title
- Time spent on page
- Referrer information
- Page type categorization
- Query parameters

### VisitorEvent

Track user interactions and events.

- Event categorization (click, scroll, form submission, etc.)
- Event data collection
- Element tracking (ID, class, text)
- Timestamped events

### VisitorMetric

Store aggregated analytics metrics.

- Daily, weekly, monthly metrics
- Multi-dimensional data
- Custom metrics and dimensions
- Flexible data model for analytics

## API Endpoints

| Method | Endpoint                           | Description                         | Authentication |
|--------|----------------------------------|-------------------------------------|----------------|
| POST   | /api/v1/visitors/track            | Track a visitor                      | No             |
| POST   | /api/v1/visitors/page-view        | Track a page view                    | No             |
| POST   | /api/v1/visitors/event            | Track a visitor event                | No             |
| GET    | /api/v1/analytics/visitors        | Get visitor analytics                | Yes (Admin)    |
| GET    | /api/v1/analytics/page-views      | Get page view analytics              | Yes (Admin)    |
| GET    | /api/v1/analytics/events          | Get event analytics                  | Yes (Admin)    |
| GET    | /api/v1/analytics/metrics         | Get calculated metrics               | Yes (Admin)    |
| GET    | /api/v1/analytics/dashboard       | Get analytics dashboard data         | Yes (Admin)    |
| GET    | /api/v1/analytics/export          | Export analytics data                | Yes (Admin)    |

## Client Integration

Include the visitor tracking script in your frontend application:

```javascript
<script src="/api/v1/visitors/tracking-script.js" async></script>
```

Or manually track page views and events:

```javascript
// Track page view
fetch('/api/v1/visitors/page-view', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    url: window.location.href,
    pageTitle: document.title,
    referrer: document.referrer
  })
});

// Track event
function trackEvent(eventType, eventName, eventData) {
  fetch('/api/v1/visitors/event', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      eventType,
      eventName,
      eventData,
      url: window.location.href
    })
  });
}

// Example: Track a button click
document.getElementById('signup-button').addEventListener('click', function() {
  trackEvent('click', 'signup_button', { buttonText: this.innerText });
});
```

## Models

### Visitor

```php
/**
 * Attributes:
 * - id: int
 * - ip_address: string
 * - user_agent: string
 * - referrer: string
 * - country: string
 * - city: string
 * - browser: string
 * - os: string
 * - device_type: string
 * - utm_source: string
 * - utm_medium: string
 * - utm_campaign: string
 * - utm_content: string
 * - utm_term: string
 * - landing_page: string
 * - language: string
 * - is_unique: boolean
 * - last_activity_at: datetime
 */
```

### VisitorSession

```php
/**
 * Attributes:
 * - id: int
 * - visitor_id: int (foreign key to visitors table)
 * - session_id: string
 * - entry_page: string
 * - exit_page: string
 * - duration: int (seconds)
 * - page_views_count: int
 * - started_at: datetime
 * - ended_at: datetime
 * - is_bounce: boolean
 * - device_info: json
 */
```

### PageView

```php
/**
 * Attributes:
 * - id: int
 * - visitor_id: int (foreign key to visitors table)
 * - visitor_session_id: int (foreign key to visitor_sessions table)
 * - url: string
 * - page_title: string
 * - referrer: string
 * - time_spent: int (seconds)
 * - query_params: json
 * - view_timestamp: datetime
 * - page_type: string
 * - route_name: string
 */
```

### VisitorEvent

```php
/**
 * Attributes:
 * - id: int
 * - visitor_id: int (foreign key to visitors table)
 * - visitor_session_id: int (foreign key to visitor_sessions table)
 * - event_type: string
 * - event_name: string
 * - event_data: json
 * - url: string
 * - occurred_at: datetime
 * - element_id: string
 * - element_class: string
 * - element_text: string
 */
```

### VisitorMetric

```php
/**
 * Attributes:
 * - id: int
 * - metric_date: date
 * - metric_type: string
 * - metric_name: string
 * - value: float
 * - dimension: string
 * - dimension_value: string
 * - additional_data: json
 */
```

## Configuration

The module provides several configuration options in `config/visitor.php`:

```php
return [
    // Whether to track visitors by default
    'enabled' => env('VISITOR_TRACKING_ENABLED', true),
    
    // IPs that should be excluded from tracking
    'excluded_ips' => [
        '127.0.0.1',
        // Add more IPs here
    ],
    
    // User agent strings that should be excluded (bots, crawlers, etc.)
    'excluded_user_agents' => [
        'bot',
        'crawl',
        'spider',
        // Add more patterns here
    ],
    
    // Whether to use IP geolocation
    'enable_geolocation' => true,
    
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
];
```

## Events

The module dispatches the following events:

- `VisitorTracked`: When a new visitor is tracked
- `SessionStarted`: When a new session begins
- `SessionEnded`: When a session ends
- `PageViewed`: When a page is viewed
- `EventTracked`: When a visitor event is tracked
- `MetricCalculated`: When a metric is calculated

## Data Aggregation

The module includes scheduled commands to aggregate visitor data:

```
# Aggregate daily metrics (run daily)
php artisan visitor:aggregate-daily

# Aggregate weekly metrics (run weekly)
php artisan visitor:aggregate-weekly

# Aggregate monthly metrics (run monthly)
php artisan visitor:aggregate-monthly

# Clean old raw data (optional, run monthly)
php artisan visitor:clean-data --older-than=90
```

## Testing

Run the tests for this module:

```
php artisan test --filter=VisitorTest
``` 
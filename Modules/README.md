# DejaVu API Modules

This directory contains all the modules for the DejaVu API project.

## Available Modules

1. **Auth Module**: Handles user authentication and registration
2. **User Module**: Manages user profiles and data
3. **Role Module**: Manages user roles and permissions
4. **Admin Module**: Admin dashboard and management functionality
5. **Author Module**: Content creation and management for authors
6. **Visitor Module**: Referral system and customer tracking

## Dashboard Information

### Admin Dashboard
- **URL**: `/api/v1/admin/dashboard`
- **Features**:
  - Key metrics widget showing statistics in visually appealing cards
  - Activity logging with recent user actions
  - Active users overview with status indicators
  - Site health monitoring with issues categorization
  - Content metrics with most popular content and publishing statistics
  - Menu management quick access widget
  - Role-based access control information
  - System settings management

### Author Dashboard
- **URL**: `/api/v1/authors/{id}`
- **Features**:
  - Author profile overview with social media links
  - Publication statistics and metrics
  - Quick action cards for content creation and management
  - Content management section showing recent and popular publications
  - Category analytics with visualization
  - Comment moderation tools with approval workflow
  - Earnings tracking
  - Tag organization

### Visitor Dashboard
- **URL**: `/api/v1/analytics/dashboard`
- **Features**:
  - Visitor and page view statistics
  - Traffic trends visualization with area charts
  - Traffic source analysis with pie charts
  - Device, browser and OS breakdowns
  - Top pages performance metrics
  - Geographical distribution of visitors
  - Event tracking for user interactions
  - Conversion rate analytics

### Common Dashboard Features
- Loading states
- Error handling
- Responsive layouts
- Data visualization components
- Consistent UI components using the design system

## Module Structure

Each module follows a consistent structure:

```
ModuleName/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   ├── Models/
│   └── Providers/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── assets/
│   └── views/
├── routes/
│   ├── api.php
│   └── web.php
├── composer.json
├── module.json
├── package.json
└── vite.config.js
```

## How to Work with Modules

### Creating a New Module

```
php artisan module:make ModuleName
```

### Creating Module Components

```
php artisan module:make-controller ControllerName ModuleName
php artisan module:make-model ModelName ModuleName
php artisan module:make-migration create_table_name ModuleName
```

### Enabling/Disabling Modules

Edit the module.json file in the module directory to add/remove service providers.

### Module Routes

Routes are defined in the module's `routes/api.php` and `routes/web.php` files.

## Setup Instructions

1. Create module migrations: `php artisan module:migrate`
2. Seed module data: `php artisan module:seed`
3. Enable modules by adding service providers back to module.json files

## Development Guidelines

1. Keep module-specific code within the module
2. Use cross-module communication through service providers or events
3. Module providers should be registered in the module.json file
4. Each module should have its own database migrations and seeders 
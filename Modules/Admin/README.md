# Admin Module

A comprehensive administration module for the DejaVu API project, providing dashboard, menu management, settings, and activity logging.

## Features

- Admin dashboard with customizable widgets
- System settings management
- Admin menu management
- Activity logging for all admin actions
- Role-based access control

## Installation

1. Make sure the module is enabled in your `modules.json` file.
2. Run migrations:
   ```
   php artisan module:migrate Admin
   ```
3. Seed the database with initial settings, menus, and dashboards:
   ```
   php artisan module:seed Admin
   ```

## Components

### AdminDashboard

Manage customizable dashboard layouts for administrators.

- Allows multiple dashboards per user
- Customizable widgets
- Responsive layout management

### AdminMenu

Manage admin panel navigation structure.

- Hierarchical menu structure (parent/child)
- Role-based menu visibility
- Custom icons and ordering

### AdminSettings

System-wide configuration management.

- Grouped settings
- Different data types (string, integer, boolean, array, etc.)
- Public/private settings control

### AdminActivity

Comprehensive activity logging system.

- Tracks all admin actions (create, update, delete)
- Records before/after values
- IP address and user agent tracking

## API Endpoints

| Method | Endpoint                     | Description                       | Authentication |
|--------|------------------------------|-----------------------------------|----------------|
| GET    | /api/v1/admin/dashboard      | Get admin dashboard               | Yes (Admin)    |
| GET    | /api/v1/admin/dashboard/data | Get dashboard widget data         | Yes (Admin)    |
| POST   | /api/v1/admin/dashboard/save | Save dashboard layout             | Yes (Admin)    |
| DELETE | /api/v1/admin/dashboard/{id} | Delete dashboard                  | Yes (Admin)    |
| GET    | /api/v1/admin/system-info    | Get system information            | Yes (Admin)    |
| GET    | /api/v1/admin/settings       | Get all settings                  | Yes (Admin)    |
| POST   | /api/v1/admin/settings       | Create new setting                | Yes (Admin)    |
| PUT    | /api/v1/admin/settings/{id}  | Update setting                    | Yes (Admin)    |
| DELETE | /api/v1/admin/settings/{id}  | Delete setting                    | Yes (Admin)    |
| GET    | /api/v1/admin/settings/public| Get public settings               | No             |
| GET    | /api/v1/admin/menus          | Get admin menu structure          | Yes (Admin)    |
| POST   | /api/v1/admin/menus          | Create menu item                  | Yes (Admin)    |
| PUT    | /api/v1/admin/menus/{id}     | Update menu item                  | Yes (Admin)    |
| DELETE | /api/v1/admin/menus/{id}     | Delete menu item                  | Yes (Admin)    |
| PUT    | /api/v1/admin/menus/order    | Update menu order                 | Yes (Admin)    |
| GET    | /api/v1/admin/activities     | Get activity logs                 | Yes (Admin)    |
| GET    | /api/v1/admin/activities/{id}| Get activity details              | Yes (Admin)    |
| GET    | /api/v1/admin/activities/export| Export activities as CSV         | Yes (Admin)    |
| GET    | /api/v1/admin/activities/recent| Get recent activities           | Yes (Admin)    |

## Models

### AdminDashboard

```php
/**
 * Attributes:
 * - id: int
 * - user_id: int (foreign key to users table)
 * - name: string
 * - is_default: boolean
 * - layout: json
 * - widgets: json
 */
```

### AdminMenu

```php
/**
 * Attributes:
 * - id: int
 * - name: string
 * - parent_id: int|null (self-referencing foreign key)
 * - route: string|null
 * - url: string|null
 * - icon: string|null
 * - permission: string|null
 * - order: int
 * - is_active: boolean
 * - is_visible: boolean
 */
```

### AdminSetting

```php
/**
 * Attributes:
 * - id: int
 * - key: string (unique)
 * - value: text
 * - group: string
 * - is_public: boolean
 * - data_type: string
 * - description: text|null
 */
```

### AdminActivity

```php
/**
 * Attributes:
 * - id: int
 * - user_id: int|null (foreign key to users table)
 * - action: string
 * - entity_type: string
 * - entity_id: int|null
 * - description: text|null
 * - ip_address: string|null
 * - user_agent: string|null
 * - before_data: json|null
 * - after_data: json|null
 */
```

## Permissions

The module uses the following permissions:

- `access admin panel`: Basic access to admin panel
- `manage settings`: Create, update, delete system settings
- `manage menu`: Manage admin navigation structure
- `view activity logs`: View system activity logs

## Testing

Run the tests for this module:

```
php artisan test --filter=AdminTest
``` 
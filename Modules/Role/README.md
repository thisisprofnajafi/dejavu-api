# Role Module

A comprehensive role and permission management module for the DejaVu API project using Spatie's Laravel Permission package.

## Features

- Role management with CRUD operations
- Permission management with CRUD operations
- Role-permission assignment
- Protection for system roles and permissions
- Integration with Laravel's Gate system
- Caching for better performance

## Installation

1. Make sure the module is enabled in your `modules.json` file.
2. Run migrations:
   ```
   php artisan module:migrate Role
   ```
3. Seed the database with initial roles and permissions:
   ```
   php artisan module:seed Role
   ```

## API Endpoints

### Role Endpoints

| Method | Endpoint                  | Description                      | Permission Required |
|--------|-----------------------------|----------------------------------|-------------------|
| GET    | /api/v1/roles               | Get all roles                    | view roles        |
| POST   | /api/v1/roles               | Create a new role                | create roles      |
| GET    | /api/v1/roles/{id}          | Get a specific role              | view roles        |
| PUT    | /api/v1/roles/{id}          | Update a role                    | edit roles        |
| DELETE | /api/v1/roles/{id}          | Delete a role                    | delete roles      |
| POST   | /api/v1/roles/{id}/permissions | Assign permissions to a role  | edit roles        |

### Permission Endpoints

| Method | Endpoint                     | Description                      | Permission Required    |
|--------|--------------------------------|----------------------------------|------------------------|
| GET    | /api/v1/permissions            | Get all permissions              | view permissions       |
| POST   | /api/v1/permissions            | Create a new permission          | create permissions     |
| GET    | /api/v1/permissions/{id}       | Get a specific permission        | view permissions       |
| PUT    | /api/v1/permissions/{id}       | Update a permission              | edit permissions       |
| DELETE | /api/v1/permissions/{id}       | Delete a permission              | delete permissions     |
| GET    | /api/v1/permissions/{id}/roles | Get roles with this permission   | view roles             |

## Request/Response Examples

### Create Role

**Request:**
```json
{
  "name": "editor",
  "permissions": [1, 2, 3]
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "role": {
      "id": 6,
      "name": "editor",
      "guard_name": "web",
      "created_at": "2023-05-01T12:00:00.000000Z",
      "updated_at": "2023-05-01T12:00:00.000000Z",
      "permissions": [
        {
          "id": 1,
          "name": "view posts",
          "guard_name": "web",
          "created_at": "2023-05-01T12:00:00.000000Z",
          "updated_at": "2023-05-01T12:00:00.000000Z"
        },
        // ... other permissions
      ]
    }
  }
}
```

### Assign Permissions to Role

**Request:**
```json
{
  "permissions": [1, 2, 3, 4]
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "role": {
      "id": 3,
      "name": "author",
      "guard_name": "web",
      "created_at": "2023-05-01T12:00:00.000000Z",
      "updated_at": "2023-05-01T12:00:00.000000Z",
      "permissions": [
        // ... assigned permissions
      ]
    }
  }
}
```

## Default Roles

The module seeds the following default roles:
- Admin - Has all permissions
- Author - Has permissions for categories and posts
- Visitor - Has permissions for wallet and customer management
- User - Basic user with minimal permissions
- Customer - Basic customer permissions

## Default Permissions

The module creates permissions for various resources including:
- Users (CRUD)
- Roles (CRUD)
- Permissions (CRUD)
- Categories (CRUD)
- Posts (CRUD)
- Stores (CRUD)
- Resumes (CRUD)
- Plans (CRUD)
- FAQs (CRUD)
- Tickets (CRUD)
- Customers (CRUD)
- Wallet management
- Receipt management

## Usage in Controllers

Here's how to check permissions in your controllers:

```php
// Using middleware
Route::get('/admin/users', [UserController::class, 'index'])
    ->middleware('can:view users');

// Within a controller
if (auth()->user()->can('edit posts')) {
    // User has permission to edit posts
}

// Check for role
if (auth()->user()->hasRole('admin')) {
    // User is an admin
}
```

## Testing

Run the tests for this module:

```
php artisan test --filter=RoleTest
``` 
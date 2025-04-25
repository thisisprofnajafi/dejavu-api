# Auth Module

A comprehensive authentication module for the DejaVu API project using Laravel Sanctum.

## Features

- User registration with optional referral code
- Login/logout functionality
- Password reset
- User profile management
- Token-based authentication using Laravel Sanctum
- Role-based authorization using Spatie Permission

## Installation

1. Make sure the module is enabled in your `modules.json` file.
2. Run migrations:
   ```
   php artisan module:migrate Auth
   ```
3. Seed the database with initial roles and users:
   ```
   php artisan module:seed Auth
   ```

## API Endpoints

| Method | Endpoint                  | Description                      | Authentication |
|--------|-----------------------------|----------------------------------|----------------|
| POST   | /api/v1/auth/register       | Register a new user              | No             |
| POST   | /api/v1/auth/login          | Login and get access token       | No             |
| POST   | /api/v1/auth/logout         | Logout and invalidate token      | Yes            |
| GET    | /api/v1/auth/user           | Get authenticated user details    | Yes            |
| POST   | /api/v1/auth/forgot-password| Request password reset link       | No             |
| POST   | /api/v1/auth/reset-password | Reset password with token         | No             |

## Request/Response Examples

### Register

**Request:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "SecurePassword123!",
  "password_confirmation": "SecurePassword123!",
  "referral_code": "ABC123XYZ456" // optional
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "referral_code": "ABC123XYZ456",
      "created_at": "2023-05-01T12:00:00.000000Z",
      "updated_at": "2023-05-01T12:00:00.000000Z"
    },
    "access_token": "1|laravel_sanctum_token...",
    "token_type": "Bearer"
  }
}
```

### Login

**Request:**
```json
{
  "email": "john@example.com",
  "password": "SecurePassword123!"
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "referral_code": "ABC123XYZ456",
      "created_at": "2023-05-01T12:00:00.000000Z",
      "updated_at": "2023-05-01T12:00:00.000000Z",
      "roles": [
        {
          "id": 1,
          "name": "user",
          "guard_name": "web",
          "created_at": "2023-05-01T12:00:00.000000Z",
          "updated_at": "2023-05-01T12:00:00.000000Z"
        }
      ]
    },
    "access_token": "1|laravel_sanctum_token...",
    "token_type": "Bearer"
  }
}
```

## Authentication

For protected routes, include the token in your request headers:

```
Authorization: Bearer 1|laravel_sanctum_token...
```

## Default Users

The module seeds the following default users for testing:

- Admin: admin@example.com / Admin@123
- Author: author@example.com / Author@123
- Visitor: visitor@example.com / Visitor@123

## Testing

Run the tests for this module:

```
php artisan test --filter=AuthTest
``` 
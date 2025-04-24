# Scrambled API Documentation

## Base URL

```
https://api.example.com/api/v1
```

## Authentication

All API endpoints except the public ones require authentication. Use the following header:

```
Authorization: Bearer {token}
```

## Error Responses

All endpoints follow a standard error format:

```json
{
  "status": "error",
  "message": "Error description"
}
```

## Public Endpoints

### Register User

- **URL**: `/register`
- **Method**: `POST`
- **Description**: Register a new user
- **Body Parameters**:
  ```json
  {
    "name": "XXXX XXXX",
    "email": "xxxx@example.com",
    "password": "********",
    "password_confirmation": "********"
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "User registered successfully",
    "data": {
      "user": {
        "id": 1,
        "name": "XXXX XXXX",
        "email": "xxxx@example.com",
        "created_at": "2023-XX-XXT00:00:00.000000Z"
      },
      "token": "xxxxxxxxxxxxxxxxxxxxx"
    }
  }
  ```

### Login User

- **URL**: `/login`
- **Method**: `POST`
- **Description**: Authenticate a user
- **Body Parameters**:
  ```json
  {
    "email": "xxxx@example.com",
    "password": "********"
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "data": {
      "user": {
        "id": 1,
        "name": "XXXX XXXX",
        "email": "xxxx@example.com",
        "roles": ["xxxxx"],
        "permissions": ["xxxx xxxxxxxx", "xxxx xxxxxx"]
      },
      "token": "xxxxxxxxxxxxxxxxxxxxx"
    }
  }
  ```

### Forgot Password

- **URL**: `/forgot-password`
- **Method**: `POST`
- **Description**: Send a password reset link
- **Body Parameters**:
  ```json
  {
    "email": "xxxx@example.com"
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "Password reset link sent to your email"
  }
  ```

### Reset Password

- **URL**: `/reset-password`
- **Method**: `POST`
- **Description**: Reset password with token
- **Body Parameters**:
  ```json
  {
    "email": "xxxx@example.com",
    "token": "xxxx_xxxxx",
    "password": "********",
    "password_confirmation": "********"
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "Password has been reset successfully"
  }
  ```

### Public FAQs

- **URL**: `/faqs`
- **Method**: `GET`
- **Description**: Get all active FAQs
- **Query Parameters**:
  - `category_id`: Filter by category
- **Response**: 
  ```json
  {
    "status": "success",
    "data": [
      {
        "id": 1,
        "question": "Xxxx xx xxxx xxx?",
        "answer": "Xxxx xx x xxxxxxxxxxx xx xxx xxx",
        "category_id": 1,
        "category": {
          "id": 1,
          "name": "Xxxxxxx"
        },
        "status": "active",
        "order": 1
      }
    ]
  }
  ```

## Authenticated Endpoints

### Logout

- **URL**: `/logout`
- **Method**: `POST`
- **Description**: Logout a user (invalidate token)
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "Logged out successfully"
  }
  ```

### Get Current User

- **URL**: `/user`
- **Method**: `GET`
- **Description**: Get current authenticated user
- **Response**: 
  ```json
  {
    "status": "success",
    "data": {
      "id": 1,
      "name": "XXXX XXXX",
      "email": "xxxx@example.com",
      "roles": ["xxxxx"],
      "permissions": ["xxxx xxxxxxxx", "xxxx xxxxxx"]
    }
  }
  ```

## Admin Endpoints

All admin endpoints require the 'admin' role or specific permissions.

### Dashboard

- **URL**: `/admin/dashboard`
- **Method**: `GET`
- **Permission**: `view dashboard`
- **Description**: Get admin dashboard statistics
- **Response**: 
  ```json
  {
    "status": "success",
    "data": {
      "users_count": 100,
      "tickets_count": 25,
      "posts_count": 50,
      "active_users": 75
    }
  }
  ```

### Settings Management

- **URL**: `/admin/settings`
- **Method**: `GET`
- **Permission**: `manage settings`
- **Description**: Get all settings
- **Response**: 
  ```json
  {
    "status": "success",
    "data": {
      "service_duration": {},
      "pricing": {},
      "notifications": {}
    }
  }
  ```

#### Get Settings by Type

- **URL**: `/admin/settings/{type}`
- **Method**: `GET`
- **Permission**: `manage settings`
- **Description**: Get settings by type
- **Response**: 
  ```json
  {
    "status": "success",
    "data": {}
  }
  ```

#### Update Settings

- **URL**: `/admin/settings/{type}`
- **Method**: `PUT`
- **Permission**: `manage settings`
- **Description**: Update settings by type
- **Body Parameters**:
  ```json
  {
    "settings": {}
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "Settings updated successfully",
    "data": {}
  }
  ```

### Resume Settings

#### Get Service Duration

- **URL**: `/admin/settings/resume/service-duration`
- **Method**: `GET`
- **Permission**: `manage settings`
- **Description**: Get resume service duration settings
- **Response**:
  ```json
  {
    "status": "success",
    "data": {
      "default_duration": 10,
      "max_duration": 30,
      "min_duration": 5
    }
  }
  ```

#### Update Service Duration

- **URL**: `/admin/settings/resume/service-duration`
- **Method**: `PUT`
- **Permission**: `manage settings`
- **Description**: Update resume service duration settings
- **Body Parameters**:
  ```json
  {
    "settings": {
      "default_duration": 10,
      "max_duration": 30,
      "min_duration": 5
    }
  }
  ```
- **Response**:
  ```json
  {
    "status": "success",
    "message": "Resume service duration settings updated successfully",
    "data": {
      "default_duration": 10,
      "max_duration": 30,
      "min_duration": 5
    }
  }
  ```

### User Management

#### List Users

- **URL**: `/admin/users`
- **Method**: `GET`
- **Permission**: `manage users`
- **Description**: Get all users with pagination
- **Query Parameters**:
  - `per_page`: Items per page (default: 15)
  - `search`: Search by name or email
  - `role`: Filter by role
  - `status`: Filter by status
- **Response**: 
  ```json
  {
    "status": "success",
    "data": {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "name": "XXXX XXXX",
          "email": "xxxx@example.com",
          "status": "active",
          "roles": ["xxxxx"]
        }
      ],
      "total": 100,
      "per_page": 15
    }
  }
  ```

#### Create User

- **URL**: `/admin/users`
- **Method**: `POST`
- **Permission**: `manage users`
- **Description**: Create a new user
- **Body Parameters**:
  ```json
  {
    "name": "XXX XXXX",
    "email": "xxxxxxx@example.com",
    "password": "********",
    "status": "active",
    "roles": ["xxxxxx"]
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "User created successfully",
    "data": {
      "id": 2,
      "name": "XXX XXXX",
      "email": "xxxxxxx@example.com",
      "status": "active",
      "roles": ["xxxxxx"]
    }
  }
  ```

### Ticket System

#### List Tickets

- **URL**: `/admin/tickets`
- **Method**: `GET`
- **Permission**: `manage tickets`
- **Description**: Get all tickets
- **Query Parameters**:
  - `status`: Filter by status
  - `priority`: Filter by priority
  - `category`: Filter by category
  - `search`: Search by subject/description
  - `with`: Include related data (comma-separated: user,assignedTo,comments)
- **Response**: 
  ```json
  {
    "status": "success",
    "data": {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "subject": "XXXX XXXX",
          "status": "open",
          "priority": "high",
          "user_id": 2,
          "assigned_to": 1,
          "category": "XXXXXXX",
          "created_at": "2023-XX-XXT00:00:00.000000Z",
          "user": {
            "id": 2,
            "name": "XXXX XXXX"
          }
        }
      ],
      "total": 25,
      "per_page": 15
    }
  }
  ```

#### Create Ticket

- **URL**: `/admin/tickets`
- **Method**: `POST`
- **Permission**: `manage tickets`
- **Description**: Create a new ticket
- **Body Parameters**:
  ```json
  {
    "subject": "XXXXX XXXX XXXXXXX",
    "description": "X XXX'X XXXX X XXXXXXX",
    "priority": "high",
    "category": "XXXXXXX",
    "assigned_to": 1
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "Ticket created successfully",
    "data": {
      "id": 2,
      "subject": "XXXXX XXXX XXXXXXX",
      "description": "X XXX'X XXXX X XXXXXXX",
      "status": "open",
      "priority": "high",
      "user_id": 2,
      "assigned_to": 1,
      "category": "XXXXXXX"
    }
  }
  ```

#### Get Ticket

- **URL**: `/admin/tickets/{id}`
- **Method**: `GET`
- **Permission**: `manage tickets`
- **Description**: Get ticket by ID with comments
- **Response**: 
  ```json
  {
    "status": "success",
    "data": {
      "id": 1,
      "subject": "XXXX XXXX",
      "description": "X XXXX XXXX XXXX...",
      "status": "open",
      "priority": "high",
      "user_id": 2,
      "assigned_to": 1,
      "category": "XXXXXXX",
      "created_at": "2023-XX-XXT00:00:00.000000Z",
      "user": {
        "id": 2,
        "name": "XXXX XXXX"
      },
      "assignedTo": {
        "id": 1,
        "name": "XXXXX XXXX"
      },
      "comments": [
        {
          "id": 1,
          "ticket_id": 1,
          "user_id": 1,
          "content": "XX'XX XXXXXXX XXXX XXXX",
          "is_internal": false,
          "created_at": "2023-XX-XXT00:00:00.000000Z",
          "user": {
            "id": 1,
            "name": "XXXXX XXXX"
          }
        }
      ]
    }
  }
  ```

#### Add Comment to Ticket

- **URL**: `/admin/tickets/{id}/comments`
- **Method**: `POST`
- **Permission**: `manage tickets`
- **Description**: Add comment to a ticket
- **Body Parameters**:
  ```json
  {
    "content": "XXXX XX X XXXXX XX XXXX XXXXXX",
    "is_internal": false
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "Comment added successfully",
    "data": {
      "id": 2,
      "ticket_id": 1,
      "user_id": 1,
      "content": "XXXX XX X XXXXX XX XXXX XXXXXX",
      "is_internal": false
    }
  }
  ```

## Author Endpoints

All author endpoints require the 'author' role or specific permissions.

### List Posts

- **URL**: `/author/posts`
- **Method**: `GET`
- **Permission**: `view posts`
- **Description**: Get posts created by the authenticated author
- **Response**: 
  ```json
  {
    "status": "success",
    "data": {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "title": "XXXX XXXXX",
          "content": "XXXX XXXXXXX",
          "status": "published",
          "user_id": 2,
          "created_at": "2023-XX-XXT00:00:00.000000Z"
        }
      ],
      "total": 10,
      "per_page": 15
    }
  }
  ```

### Create Post

- **URL**: `/author/posts`
- **Method**: `POST`
- **Permission**: `create posts`
- **Description**: Create a new post
- **Body Parameters**:
  ```json
  {
    "title": "XXX XXXX",
    "content": "XXXX XXXXXXX XXXX XXXX",
    "status": "draft",
    "category_id": 1,
    "tags": ["xxxx", "xxxx"]
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "Post created successfully",
    "data": {
      "id": 2,
      "title": "XXX XXXX",
      "content": "XXXX XXXXXXX XXXX XXXX",
      "status": "draft",
      "user_id": 2,
      "category_id": 1,
      "created_at": "2023-XX-XXT00:00:00.000000Z"
    }
  }
  ```

## Visitor Endpoints

All visitor endpoints require the 'visitor' role or specific permissions.

### Wallet

- **URL**: `/visitor/wallet`
- **Method**: `GET`
- **Permission**: `view wallet`
- **Description**: Get wallet balance and recent transactions
- **Response**: 
  ```json
  {
    "status": "success",
    "data": {
      "balance": 100.50,
      "currency": "USD",
      "recent_transactions": [
        {
          "id": 1,
          "type": "xxxxxxx",
          "amount": 50.00,
          "status": "xxxxxxxxx",
          "created_at": "2023-XX-XXT00:00:00.000000Z"
        }
      ]
    }
  }
  ```

### Receipts

- **URL**: `/visitor/receipts`
- **Method**: `GET`
- **Permission**: `view receipts`
- **Description**: Get user's receipts
- **Response**: 
  ```json
  {
    "status": "success",
    "data": {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "transaction_id": "XXXXXXXX",
          "amount": 50.00,
          "date": "2023-XX-XX",
          "status": "paid",
          "download_url": "https://example.com/xxxxxxxx/1"
        }
      ],
      "total": 5,
      "per_page": 15
    }
  }
  ```

### Referrals

- **URL**: `/visitor/referrals`
- **Method**: `GET`
- **Permission**: `view referrals`
- **Description**: Get user's referrals
- **Response**: 
  ```json
  {
    "status": "success",
    "data": {
      "referral_code": "XXXXXX",
      "total_referrals": 5,
      "pending_commissions": 25.00,
      "paid_commissions": 75.00,
      "referrals": [
        {
          "id": 1,
          "user_name": "XXXXXXXX XXXX",
          "date": "2023-XX-XX",
          "status": "active",
          "commission": 15.00
        }
      ]
    }
  }
  ``` 
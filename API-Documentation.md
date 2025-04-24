# API Documentation

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
    "name": "User Name",
    "email": "user@example.com",
    "password": "password",
    "password_confirmation": "password"
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
        "name": "User Name",
        "email": "user@example.com",
        "created_at": "2023-01-01T00:00:00.000000Z"
      },
      "token": "access_token_string"
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
    "email": "user@example.com",
    "password": "password"
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "data": {
      "user": {
        "id": 1,
        "name": "User Name",
        "email": "user@example.com",
        "roles": ["visitor"],
        "permissions": ["view dashboard", "view wallet"]
      },
      "token": "access_token_string"
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
    "email": "user@example.com"
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
    "email": "user@example.com",
    "token": "reset_token",
    "password": "new_password",
    "password_confirmation": "new_password"
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
        "question": "What is this app?",
        "answer": "This is a description of the app",
        "category_id": 1,
        "category": {
          "id": 1,
          "name": "General"
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
      "name": "User Name",
      "email": "user@example.com",
      "roles": ["visitor"],
      "permissions": ["view dashboard", "view wallet"]
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
          "name": "User Name",
          "email": "user@example.com",
          "status": "active",
          "roles": ["admin"]
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
    "name": "New User",
    "email": "newuser@example.com",
    "password": "password",
    "status": "active",
    "roles": ["visitor"]
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "User created successfully",
    "data": {
      "id": 2,
      "name": "New User",
      "email": "newuser@example.com",
      "status": "active",
      "roles": ["visitor"]
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
          "subject": "Need help",
          "status": "open",
          "priority": "high",
          "user_id": 2,
          "assigned_to": 1,
          "category": "Support",
          "created_at": "2023-01-01T00:00:00.000000Z",
          "user": {
            "id": 2,
            "name": "User Name"
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
    "subject": "Issue with payment",
    "description": "I can't make a payment",
    "priority": "high",
    "category": "Billing",
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
      "subject": "Issue with payment",
      "description": "I can't make a payment",
      "status": "open",
      "priority": "high",
      "user_id": 2,
      "assigned_to": 1,
      "category": "Billing"
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
      "subject": "Need help",
      "description": "I need help with...",
      "status": "open",
      "priority": "high",
      "user_id": 2,
      "assigned_to": 1,
      "category": "Support",
      "created_at": "2023-01-01T00:00:00.000000Z",
      "user": {
        "id": 2,
        "name": "User Name"
      },
      "assignedTo": {
        "id": 1,
        "name": "Admin User"
      },
      "comments": [
        {
          "id": 1,
          "ticket_id": 1,
          "user_id": 1,
          "content": "We're looking into this",
          "is_internal": false,
          "created_at": "2023-01-01T00:00:00.000000Z",
          "user": {
            "id": 1,
            "name": "Admin User"
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
    "content": "This is a reply to your ticket",
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
      "content": "This is a reply to your ticket",
      "is_internal": false
    }
  }
  ```

#### Update Ticket Status

- **URL**: `/admin/tickets/{id}/status`
- **Method**: `PUT`
- **Permission**: `manage tickets`
- **Description**: Update ticket status
- **Body Parameters**:
  ```json
  {
    "status": "in_progress",
    "add_comment": true
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "Ticket status updated successfully",
    "data": {
      "id": 1,
      "subject": "Need help",
      "status": "in_progress"
    }
  }
  ```

#### Assign Ticket

- **URL**: `/admin/tickets/{id}/assign`
- **Method**: `PUT`
- **Permission**: `manage tickets`
- **Description**: Assign ticket to a user
- **Body Parameters**:
  ```json
  {
    "user_id": 1,
    "add_comment": true
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "Ticket assigned successfully",
    "data": {
      "id": 1,
      "subject": "Need help",
      "assigned_to": 1,
      "assignedTo": {
        "id": 1,
        "name": "Admin User"
      }
    }
  }
  ```

### FAQ Management

#### List FAQ Categories

- **URL**: `/admin/faqs/categories`
- **Method**: `GET`
- **Permission**: `manage faqs`
- **Description**: Get all FAQ categories
- **Query Parameters**:
  - `status`: Filter by status
  - `with_faqs`: Include FAQs (boolean)
- **Response**: 
  ```json
  {
    "status": "success",
    "data": {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "name": "General",
          "description": "General questions",
          "status": "active",
          "order": 1
        }
      ],
      "total": 5,
      "per_page": 15
    }
  }
  ```

#### Create FAQ Category

- **URL**: `/admin/faqs/categories`
- **Method**: `POST`
- **Permission**: `manage faqs`
- **Description**: Create a new FAQ category
- **Body Parameters**:
  ```json
  {
    "name": "New Category",
    "description": "New category description",
    "status": "active",
    "order": 2
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "FAQ category created successfully",
    "data": {
      "id": 2,
      "name": "New Category",
      "description": "New category description",
      "status": "active",
      "order": 2
    }
  }
  ```

#### List FAQs

- **URL**: `/admin/faqs`
- **Method**: `GET`
- **Permission**: `manage faqs`
- **Description**: Get all FAQs
- **Query Parameters**:
  - `status`: Filter by status
  - `category_id`: Filter by category
  - `with_category`: Include category (boolean)
- **Response**: 
  ```json
  {
    "status": "success",
    "data": {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "question": "What is this app?",
          "answer": "This is a description of the app",
          "category_id": 1,
          "category": {
            "id": 1,
            "name": "General"
          },
          "status": "active",
          "order": 1
        }
      ],
      "total": 10,
      "per_page": 15
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
          "title": "Post Title",
          "content": "Post content",
          "status": "published",
          "user_id": 2,
          "created_at": "2023-01-01T00:00:00.000000Z"
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
    "title": "New Post",
    "content": "Post content goes here",
    "status": "draft",
    "category_id": 1,
    "tags": ["tag1", "tag2"]
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "Post created successfully",
    "data": {
      "id": 2,
      "title": "New Post",
      "content": "Post content goes here",
      "status": "draft",
      "user_id": 2,
      "category_id": 1,
      "created_at": "2023-01-01T00:00:00.000000Z"
    }
  }
  ```

### Update Post

- **URL**: `/author/posts/{id}`
- **Method**: `PUT`
- **Permission**: `edit own posts`
- **Description**: Update an existing post
- **Body Parameters**:
  ```json
  {
    "title": "Updated Post Title",
    "content": "Updated content",
    "status": "published",
    "category_id": 2
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "Post updated successfully",
    "data": {
      "id": 1,
      "title": "Updated Post Title",
      "content": "Updated content",
      "status": "published",
      "user_id": 2,
      "category_id": 2
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
          "type": "deposit",
          "amount": 50.00,
          "status": "completed",
          "created_at": "2023-01-01T00:00:00.000000Z"
        }
      ]
    }
  }
  ```

### Withdraw Funds

- **URL**: `/visitor/wallet/withdraw`
- **Method**: `POST`
- **Permission**: `withdraw funds`
- **Description**: Request a funds withdrawal
- **Body Parameters**:
  ```json
  {
    "amount": 50.00,
    "payment_method": "paypal",
    "payment_details": {
      "email": "user@example.com"
    }
  }
  ```
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "Withdrawal request submitted successfully",
    "data": {
      "id": 1,
      "amount": 50.00,
      "status": "pending",
      "payment_method": "paypal",
      "created_at": "2023-01-01T00:00:00.000000Z"
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
          "transaction_id": "TXN123456",
          "amount": 50.00,
          "date": "2023-01-01",
          "status": "paid",
          "download_url": "https://example.com/receipts/1"
        }
      ],
      "total": 5,
      "per_page": 15
    }
  }
  ```

### Generate Receipt

- **URL**: `/visitor/receipts/{transaction_id}/generate`
- **Method**: `POST`
- **Permission**: `generate receipts`
- **Description**: Generate a receipt for a transaction
- **Response**: 
  ```json
  {
    "status": "success",
    "message": "Receipt generated successfully",
    "data": {
      "id": 2,
      "transaction_id": "TXN123457",
      "download_url": "https://example.com/receipts/2"
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
      "referral_code": "REF123",
      "total_referrals": 5,
      "pending_commissions": 25.00,
      "paid_commissions": 75.00,
      "referrals": [
        {
          "id": 1,
          "user_name": "Referred User",
          "date": "2023-01-01",
          "status": "active",
          "commission": 15.00
        }
      ]
    }
  }
  ``` 
# DejaVu API - Modular Laravel Project

## Project Overview
A multi-store platform allowing customers to create stores or resumes, with a visitor referral system. The platform supports multiple user roles with different permissions and functionalities.

## Technology Stack
- Laravel 12
- Laravel Modules (nwidart/laravel-modules)
- Laravel Sanctum for Authentication
- Spatie Permission for Role Management
- Dedoc Scramble for API Documentation

## Modular Structure

### Core Modules

1. **Auth Module**
   - Handles authentication using Sanctum
   - User registration with optional referral code
   - Login, logout, password reset
   - Token management

2. **User Module**
   - User management (CRUD)
   - Role assignment (Admin, Author, Visitor, User, Customer)
   - Profile management
   - User statistics

3. **Role Module**
   - Permission management
   - Role definitions
   - Role assignment

4. **Admin Module**
   - Dashboard with analytics
   - User management
   - Store/Resume management
   - Plan management
   - System settings

5. **Author Module**
   - Content management
   - Category management
   - Post management with SEO capabilities

6. **Visitor Module**
   - Referral code management (12-character unique code)
   - Wallet management
   - Receipt management
   - Customer tracking
   - Commission tracking

7. **Store Module**
   - Store creation and management
   - Store settings
   - Contract management
   - Pricing

8. **Resume Module**
   - Resume creation and management
   - Resume settings
   - Contract management
   - Pricing

9. **Content Module**
   - Post management
   - Category management
   - Tag management
   - SEO management

10. **Support Module**
    - Ticket system
    - FAQ management
    - Contact forms

11. **Billing Module**
    - Payment processing
    - Invoice generation
    - Wallet management
    - Commission calculation

## Database Structure

### Main Entities

1. **Users**
   - Basic user information
   - Authentication data
   - Role assignments

2. **Roles & Permissions**
   - Role definitions
   - Permission assignments

3. **Stores**
   - Store details
   - Contract information
   - Owner information
   - Pricing information

4. **Resumes**
   - Resume details
   - Contract information
   - Owner information
   - Pricing information

5. **Posts**
   - Content information
   - SEO metadata
   - Categories and tags
   - Author information

6. **Categories**
   - Hierarchical structure
   - Meta information

7. **Plans**
   - Plan details
   - Pricing
   - Features

8. **Visitors**
   - Referral code
   - Commission settings
   - Wallet information

9. **Receipts**
   - Transaction details
   - Product information
   - User information
   - Payment status

10. **Tickets**
    - Support ticket details
    - Status tracking
    - User information

## Implementation Steps

### Phase 1: Setup and Authentication

1. **Initialize Modules Structure**
   - Set up laravel-modules configuration
   - Create base module structure

2. **Setup Authentication**
   - Configure Sanctum
   - Implement authentication endpoints
   - Set up user registration with referral code

3. **Implement Role System**
   - Configure spatie/laravel-permission
   - Define basic roles (Admin, Author, Visitor)
   - Implement permissions

### Phase 2: Admin Functionality

1. **Admin Module Implementation**
   - Dashboard
   - User management
   - Store/Resume settings
   - Plan management
   - Contract management
   - Notification system for contract expiry

2. **Content Management**
   - Post CRUD
   - Category CRUD
   - Tag system
   - SEO metadata

3. **Support System**
   - Ticket system
   - FAQ management

### Phase 3: Author Functionality

1. **Author Management**
   - Category management
   - Post management with limited permissions
   - Content approval workflow

### Phase 4: Visitor System

1. **Visitor Module Implementation**
   - Referral code generation
   - Wallet management
   - Receipt system
   - Customer tracking
   - Commission calculation

### Phase 5: API Integration and Documentation

1. **API Documentation**
   - Configure Scramble
   - Document all endpoints
   - Create API authentication guide

2. **API Testing**
   - Create test suite
   - Implement automated testing

## Role-based Features

### Admin Actions
- Resume and store settings management
- Contract duration and pricing
- Expiration reminders (2 weeks before)
- User management
- Customer management
- FAQ management
- Ticket system
- Post categories management
- Posts management (title, text, images, tags, SEO)
- Plan management (title, description, price, image)
- Author management (role assignment and permissions)

### Author Actions
- Category management (title) - CRUD operations
- Post management (limited to own posts)
- Content creation with SEO capabilities

### Visitor Actions
- Wallet management
- Payment facilitation for users
- Receipt management
- Customer management (tracking referrals)
- Referral code system (12-character unique code)
- Commission tracking

## API Endpoints Summary

1. **Authentication**
   - POST /api/auth/register
   - POST /api/auth/login
   - POST /api/auth/logout
   - GET /api/auth/user
   - POST /api/auth/password/reset

2. **User Management**
   - GET /api/users
   - POST /api/users
   - GET /api/users/{id}
   - PUT /api/users/{id}
   - DELETE /api/users/{id}
   - GET /api/users/{id}/roles

3. **Role Management**
   - GET /api/roles
   - POST /api/roles
   - GET /api/roles/{id}
   - PUT /api/roles/{id}
   - DELETE /api/roles/{id}
   - POST /api/roles/{id}/permissions

4. **Content Management**
   - GET /api/categories
   - POST /api/categories
   - GET /api/categories/{id}
   - PUT /api/categories/{id}
   - DELETE /api/categories/{id}
   - GET /api/posts
   - POST /api/posts
   - GET /api/posts/{id}
   - PUT /api/posts/{id}
   - DELETE /api/posts/{id}

5. **Visitor System**
   - GET /api/visitor/referral
   - GET /api/visitor/wallet
   - POST /api/visitor/wallet/deposit
   - GET /api/visitor/customers
   - GET /api/visitor/commissions

6. **Admin Dashboard**
   - GET /api/admin/dashboard/stats
   - GET /api/admin/users
   - GET /api/admin/stores
   - GET /api/admin/resumes
   - GET /api/admin/plans
   - GET /api/admin/tickets

7. **Store & Resume Management**
   - GET /api/stores
   - POST /api/stores
   - GET /api/stores/{id}
   - PUT /api/stores/{id}
   - DELETE /api/stores/{id}
   - GET /api/resumes
   - POST /api/resumes
   - GET /api/resumes/{id}
   - PUT /api/resumes/{id}
   - DELETE /api/resumes/{id}

## Getting Started

1. Clone the repository
2. Run `composer install`
3. Configure the `.env` file
4. Run migrations: `php artisan migrate`
5. Seed the database: `php artisan db:seed`
6. Generate modules: `php artisan module:make Auth`
7. Generate API documentation: `php artisan scramble:generate`

## Development Workflow

1. Create a module: `php artisan module:make ModuleName`
2. Generate module components: `php artisan module:make-controller ControllerName ModuleName`
3. Define routes in the module's routes/api.php file
4. Implement controllers and models
5. Apply permissions using spatie/laravel-permission
6. Document API endpoints with Scramble annotations 
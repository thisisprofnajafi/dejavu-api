# Laravel Modular API Task List with Sanctum Authentication

## Overview
This document outlines the tasks required to build a modular Laravel API with Sanctum authentication, role-based permissions, and automated deployment via GitHub Actions.

## Table of Contents
- [Project Setup](#project-setup)
- [API Structure](#api-structure)
- [Authentication System](#authentication-system)
- [Role and Permission System](#role-and-permission-system)
- [Module Implementation](#module-implementation)
- [Testing](#testing)
- [CI/CD with GitHub Actions](#cicd-with-github-actions)

## Project Setup

### Initial Setup
- [ ] Install Laravel using Composer
- [ ] Configure environment settings (.env file)
- [ ] Setup database connection
- [x] Install required packages
  - [x] Laravel Sanctum for API authentication
  - [x] Spatie Permission package for role management

### Project Structure
- [x] Create modules directory structure
- [x] Configure namespaces for modular approach
- [x] Setup service providers for module loading

## API Structure

### API Versioning
- [x] Implement API versioning (v1, v2, etc.)
- [x] Create versioned route files
- [x] Set up API response structure
  - [x] Standard success responses
  - [x] Standard error responses

### Base Resources
- [x] Create base resource controllers
- [x] Implement API resource classes
- [x] Set up transformers for consistent response formatting

## Authentication System

### Sanctum Configuration
- [x] Install and configure Laravel Sanctum
- [x] Set up Sanctum middleware
- [x] Configure token lifetimes and settings

### Authentication Endpoints
- [x] Implement user registration endpoint
  - [x] Validation
  - [x] User creation
  - [x] Default role assignment
- [x] Implement login endpoint
  - [x] Credentials validation
  - [x] Token generation
  - [x] User data return
- [x] Implement logout endpoint
- [x] Implement password reset flow
- [x] Implement token refresh endpoint

### User Management
- [x] Create User model with necessary fields
- [x] Implement user profile endpoints
  - [x] Get profile
  - [x] Update profile
  - [x] Delete account

## Role and Permission System

### Spatie Configuration
- [x] Install Spatie Laravel Permission package
- [x] Run migrations for roles and permissions tables
- [x] Configure role/permission caching

### Role Implementation
- [x] Create default roles:
  - [x] Admin role
  - [x] Author role
  - [x] Visitor role
- [x] Define role hierarchy

### Permission Implementation
- [x] Define granular permissions for each module
- [x] Create permission groups based on modules
- [x] Assign permissions to roles
- [x] Implement permission checking middleware

### Role/Permission Management API
- [x] Create endpoints for role management (admin only)
  - [x] Create role
  - [x] Update role
  - [x] Delete role
  - [x] List roles
- [x] Implement permission assignment endpoints
  - [x] Assign permissions to role
  - [x] Remove permissions from role
  - [x] Assign direct permissions to users
- [x] Create user-role assignment endpoints
  - [x] Assign role to user
  - [x] Remove role from user
  - [x] Get user roles

## Module Implementation

Based on the menu structure from our dashboard, implement the following modules:

### Admin Module
- [x] Dashboard API endpoints
- [x] Store Settings Module
  - [x] Service duration management
  - [x] Pricing management 
  - [x] Notifications settings
- [ ] Resume Settings Module
  - [ ] Service duration endpoints
  - [ ] Pricing endpoints
  - [ ] Notifications endpoints
- [x] User Management endpoints
- [ ] Customer Management endpoints
- [ ] Ticket System endpoints
- [ ] FAQ Management endpoints
- [ ] Commission Management endpoints
- [x] Content Management Module
  - [x] Posts CRUD endpoints
  - [x] Pages CRUD endpoints
  - [x] Categories CRUD endpoints
- [ ] Author Management endpoints
- [ ] Payment Management endpoints

### Author Module
- [ ] Dashboard API endpoints
- [x] Posts Management Module
  - [x] List posts endpoint
  - [x] Create post endpoint
  - [x] Update post endpoint
  - [x] Drafts management endpoints
- [x] Categories Management Module
  - [x] List categories endpoint
  - [x] Create category endpoint
- [ ] Analytics endpoints

### Visitor Module
- [ ] Dashboard API endpoints
- [ ] Wallet Module
  - [ ] Balance endpoint
  - [ ] Transactions list endpoint
  - [ ] Withdrawal endpoints
- [ ] Receipts Module
  - [ ] List receipts endpoint
  - [ ] Generate receipt endpoint
- [ ] Referrals Module
  - [ ] Listed users endpoint
  - [ ] Commission endpoints

## Testing

### Unit Testing
- [ ] Write unit tests for each module
- [ ] Test authentication flows
- [ ] Test permission checks

### Feature Testing
- [ ] Create API feature tests for each endpoint
- [ ] Test role-based access control

### Test Automation
- [ ] Configure PHPUnit
- [ ] Set up database for testing
- [ ] Configure test environment

## CI/CD with GitHub Actions

### Repository Setup
- [ ] Initialize Git repository
- [ ] Create development, staging, and main branches
- [ ] Set up branch protection rules

### GitHub Actions Configuration

#### Continuous Integration
- [ ] Create `.github/workflows/test.yml` file with the following:
```yaml
name: Run Tests

on:
  push:
    branches: [ development, staging, main ]
  pull_request:
    branches: [ development, staging, main ]

jobs:
  laravel-tests:
    runs-on: ubuntu-latest
    
    services:
      mysql:
        image: mysql:8.0
        env:
          MYSQL_ROOT_PASSWORD: password
          MYSQL_DATABASE: test_db
        ports:
          - 3306:3306
        options: --health-cmd="mysqladmin ping" --health-interval=10s --health-timeout=5s --health-retries=3
    
    steps:
    - uses: actions/checkout@v3
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.4'
        extensions: mbstring, dom, fileinfo, mysql
        coverage: xdebug
    
    - name: Copy .env
      run: php -r "file_exists('.env') || copy('.env.example', '.env');"
    
    - name: Install Composer Dependencies
      run: composer install --prefer-dist --no-progress --no-suggest
    
    - name: Generate Application Key
      run: php artisan key:generate
    
    - name: Directory Permissions
      run: chmod -R 777 storage bootstrap/cache
    
    - name: Configure Database
      run: |
        php artisan config:clear
        php artisan migrate --force
    
    - name: Execute Tests
      run: php artisan test --coverage-clover=coverage.xml
    
    - name: Upload coverage to Codecov
      uses: codecov/codecov-action@v3
      with:
        file: ./coverage.xml
```

#### Continuous Deployment

##### Development Environment Deployment
- [ ] Create `.github/workflows/deploy-dev.yml` file:
```yaml
name: Deploy to Development

on:
  push:
    branches: [ development ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
    - uses: actions/checkout@v3
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.4'
        extensions: mbstring, dom, fileinfo, mysql
    
    - name: Install Dependencies
      run: composer install --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist --optimize-autoloader
    
    - name: Deploy to Server
      uses: appleboy/ssh-action@master
      with:
        host: ${{ secrets.DEV_HOST }}
        username: ${{ secrets.DEV_USERNAME }}
        key: ${{ secrets.DEV_SSH_KEY }}
        script: |
          cd /var/www/dev-api
          git pull origin development
          composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader
          php artisan migrate --force
          php artisan config:cache
          php artisan route:cache
          php artisan view:cache
```

##### Staging Environment Deployment
- [ ] Create `.github/workflows/deploy-staging.yml` file:
```yaml
name: Deploy to Staging

on:
  push:
    branches: [ staging ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
    - uses: actions/checkout@v3
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.4'
        extensions: mbstring, dom, fileinfo, mysql
    
    - name: Install Dependencies
      run: composer install --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist --optimize-autoloader
    
    - name: Deploy to Server
      uses: appleboy/ssh-action@master
      with:
        host: ${{ secrets.STAGING_HOST }}
        username: ${{ secrets.STAGING_USERNAME }}
        key: ${{ secrets.STAGING_SSH_KEY }}
        script: |
          cd /var/www/staging-api
          git pull origin staging
          composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader
          php artisan migrate --force
          php artisan config:cache
          php artisan route:cache
          php artisan view:cache
```

##### Production Environment Deployment
- [ ] Create `.github/workflows/deploy-production.yml` file:
```yaml
name: Deploy to Production

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
    - uses: actions/checkout@v3
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.4'
        extensions: mbstring, dom, fileinfo, mysql
    
    - name: Install Dependencies
      run: composer install --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist --optimize-autoloader
    
    - name: Deploy to Server
      uses: appleboy/ssh-action@master
      with:
        host: ${{ secrets.PROD_HOST }}
        username: ${{ secrets.PROD_USERNAME }}
        key: ${{ secrets.PROD_SSH_KEY }}
        script: |
          cd /var/www/api
          git pull origin main
          composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader
          php artisan migrate --force
          php artisan config:cache
          php artisan route:cache
          php artisan view:cache
          php artisan optimize
```

### GitHub Secrets Setup
- [ ] Configure GitHub repository secrets:
  - [ ] Database credentials
  - [ ] SSH keys for deployment
  - [ ] Server details
  - [ ] API keys for third-party services

### Deployment Documentation
- [ ] Create deployment documentation
- [ ] Document rollback procedures
- [ ] Document server environment setup

## Final Steps
- [ ] Create comprehensive API documentation
- [ ] Set up API rate limiting
- [ ] Configure CORS for frontend access
- [ ] Implement request logging
- [ ] Review and enhance security measures 
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
- [x] Resume Settings Module
  - [x] Service duration endpoints
  - [x] Pricing endpoints
  - [x] Notifications endpoints
- [x] User Management endpoints
- [x] Customer Management endpoints
- [x] Ticket System endpoints
- [x] FAQ Management endpoints
  - [x] FAQ Category CRUD endpoints
  - [x] FAQ CRUD endpoints
  - [x] FAQ ordering functionality
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

## Final Steps
- [ ] Create comprehensive API documentation
- [ ] Set up API rate limiting
- [ ] Configure CORS for frontend access
- [ ] Implement request logging
- [ ] Review and enhance security measures
  - [x] Implement proper validation for all API endpoints
  - [x] Use database transactions for data integrity
  - [x] Implement role-based access control for all routes
  - [ ] Configure API rate limiting
  - [ ] Set up comprehensive request logging 
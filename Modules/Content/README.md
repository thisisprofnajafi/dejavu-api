# Content Module

Content management module for DejaVu API.

## Features

- Post management with CRUD operations
- Category management with hierarchical structure
- Tag management
- SEO optimization and management

## Installation

This module is part of the DejaVu API. It is installed by default.

## API Documentation

### Posts

`GET /api/posts` - List all posts
- Filterable by status, category_id, search
- Pagination supported

`POST /api/posts` - Create a new post
- Required: title, content, status, category_id
- Optional: slug, excerpt, featured_image, tags, published_at, SEO metadata

`GET /api/posts/{post}` - Get a specific post

`PUT /api/posts/{post}` - Update a post

`DELETE /api/posts/{post}` - Delete a post

### Categories

`GET /api/categories` - List all categories
- Filterable by search, hierarchical
- Pagination supported

`POST /api/categories` - Create a new category
- Required: title
- Optional: slug, description, parent_id, featured_image, SEO metadata

`GET /api/categories/{category}` - Get a specific category

`PUT /api/categories/{category}` - Update a category

`DELETE /api/categories/{category}` - Delete a category

### Tags

`GET /api/tags` - List all tags
- Filterable by search
- Pagination supported

`POST /api/tags` - Create a new tag
- Required: name
- Optional: slug

`GET /api/tags/{tag}` - Get a specific tag

`PUT /api/tags/{tag}` - Update a tag

`DELETE /api/tags/{tag}` - Delete a tag

### SEO

`POST /api/seo` - Create SEO settings for a resource
- Required: meta_title, seoable_id, seoable_type
- Optional: meta_description, meta_keywords, og_title, og_description, og_image, twitter_title, twitter_description, twitter_image, canonical_url

`GET /api/seo/{type}/{id}` - Get SEO settings for a resource

`PUT /api/seo/{type}/{id}` - Update SEO settings for a resource

`DELETE /api/seo/{type}/{id}` - Delete SEO settings for a resource

## Permissions

This module uses the Spatie Permission package to manage permissions. The following permissions are defined:

- content.posts.view
- content.posts.create
- content.posts.edit
- content.posts.delete
- content.categories.view
- content.categories.create
- content.categories.edit
- content.categories.delete
- content.tags.view
- content.tags.create
- content.tags.edit
- content.tags.delete
- content.seo.view
- content.seo.create
- content.seo.edit
- content.seo.delete 
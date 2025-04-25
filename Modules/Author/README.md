# Author Module

A comprehensive author management module for the DejaVu API project, enabling content creation, publication, and author profiles.

## Features

- Author profiles with user accounts
- Publication management
- Category and tag organization
- Comment system
- Author statistics tracking
- Content moderation tools

## Installation

1. Make sure the module is enabled in your `modules.json` file.
2. Run migrations:
   ```
   php artisan module:migrate Author
   ```
3. Seed the database with initial categories, tags, and sample data:
   ```
   php artisan module:seed Author
   ```

## Components

### Author

The core model representing content creators with profiles.

- Profile management (bio, website, social media)
- Verification system
- Publication association
- Statistics tracking

### Publication

Represents content created by authors.

- Rich content management
- Category and tag organization
- SEO metadata
- Comment system
- View tracking

### Category

Hierarchical organization for publications.

- Nested categories (parent/child)
- Slugs for SEO-friendly URLs
- Associated publications

### Tag

Flexible tagging system for publications.

- Custom colors
- Associated publications
- SEO-friendly slugs

### Comment

User feedback and discussion for publications.

- Nested comments (parent/child replies)
- Moderation tools
- User association

### AuthorStatistic

Track key metrics for authors.

- Publication count
- View tracking
- Engagement metrics (comments, likes, shares)
- Follower count

## API Endpoints

| Method | Endpoint                              | Description                        | Authentication      |
|--------|------------------------------------|----------------------------------|-------------------|
| GET    | /api/v1/authors                     | List all authors                  | No                |
| GET    | /api/v1/authors/{id}                | Get specific author               | No                |
| GET    | /api/v1/authors/{id}/statistics     | Get author statistics             | No                |
| GET    | /api/v1/authors/{id}/publications   | Get author publications           | No                |
| POST   | /api/v1/authors                     | Create author profile             | Yes (User)        |
| PUT    | /api/v1/authors/{id}                | Update author profile             | Yes (Author/Admin)|
| DELETE | /api/v1/authors/{id}                | Delete author profile             | Yes (Admin)       |
| GET    | /api/v1/publications                | List publications                 | No                |
| GET    | /api/v1/publications/{id}           | Get specific publication          | No                |
| POST   | /api/v1/publications                | Create publication                | Yes (Author)      |
| PUT    | /api/v1/publications/{id}           | Update publication                | Yes (Author/Admin)|
| DELETE | /api/v1/publications/{id}           | Delete publication                | Yes (Author/Admin)|
| GET    | /api/v1/categories                  | List all categories               | No                |
| GET    | /api/v1/categories/{id}             | Get specific category             | No                |
| GET    | /api/v1/categories/{id}/publications| Get category publications         | No                |
| POST   | /api/v1/categories                  | Create category                   | Yes (Admin)       |
| PUT    | /api/v1/categories/{id}             | Update category                   | Yes (Admin)       |
| DELETE | /api/v1/categories/{id}             | Delete category                   | Yes (Admin)       |
| GET    | /api/v1/tags                        | List all tags                     | No                |
| GET    | /api/v1/tags/{id}                   | Get specific tag                  | No                |
| GET    | /api/v1/tags/{id}/publications      | Get tag publications              | No                |
| POST   | /api/v1/tags                        | Create tag                        | Yes (Admin)       |
| PUT    | /api/v1/tags/{id}                   | Update tag                        | Yes (Admin)       |
| DELETE | /api/v1/tags/{id}                   | Delete tag                        | Yes (Admin)       |
| GET    | /api/v1/publications/{id}/comments  | Get publication comments          | No                |
| POST   | /api/v1/publications/{id}/comments  | Create comment                    | Yes (User)        |
| PUT    | /api/v1/comments/{id}               | Update comment                    | Yes (Author/Admin)|
| DELETE | /api/v1/comments/{id}               | Delete comment                    | Yes (Author/Admin)|

## Models

### Author

```php
/**
 * Attributes:
 * - id: int
 * - user_id: int (foreign key to users table)
 * - bio: text|null
 * - website: string|null
 * - social_media: json|null
 * - pseudonym: string|null
 * - is_verified: boolean
 * - verification_date: datetime|null
 * - avatar: string|null
 * - cover_image: string|null
 * - status: string
 */
```

### Publication

```php
/**
 * Attributes:
 * - id: int
 * - author_id: int (foreign key to authors table)
 * - title: string
 * - slug: string (unique)
 * - description: text|null
 * - content: longtext
 * - cover_image: string|null
 * - published_at: datetime|null
 * - status: string (draft, published, archived)
 * - is_featured: boolean
 * - meta_title: string|null
 * - meta_description: text|null
 * - meta_keywords: string|null
 * - reading_time: int
 * - view_count: int
 */
```

### Category

```php
/**
 * Attributes:
 * - id: int
 * - name: string
 * - slug: string (unique)
 * - description: text|null
 * - parent_id: int|null (self-referencing foreign key)
 * - is_active: boolean
 * - icon: string|null
 * - order: int
 */
```

### Tag

```php
/**
 * Attributes:
 * - id: int
 * - name: string
 * - slug: string (unique)
 * - description: text|null
 * - color: string|null
 * - is_active: boolean
 */
```

### Comment

```php
/**
 * Attributes:
 * - id: int
 * - user_id: int|null (foreign key to users table)
 * - publication_id: int (foreign key to publications table)
 * - parent_id: int|null (self-referencing foreign key)
 * - content: text
 * - status: string (active, spam, deleted)
 * - is_approved: boolean
 */
```

### AuthorStatistic

```php
/**
 * Attributes:
 * - id: int
 * - author_id: int (foreign key to authors table)
 * - publication_count: int
 * - total_views: int
 * - total_comments: int
 * - total_likes: int
 * - total_shares: int
 * - average_rating: float
 * - total_followers: int
 * - total_awards: int
 * - last_publication_date: datetime|null
 */
```

## Permissions

The module uses the following permissions:

- `manage authors`: Create, update, delete author profiles
- `manage publications`: Create, update, delete publications
- `manage categories`: Create, update, delete categories
- `manage tags`: Create, update, delete tags
- `manage comments`: Moderate comments
- `publish content`: Ability to publish content (set status to published)
- `feature content`: Ability to feature content

## Events

The module dispatches the following events:

- `AuthorCreated`: When a new author profile is created
- `PublicationPublished`: When a publication is published
- `CommentCreated`: When a new comment is created
- `PublicationViewed`: When a publication is viewed

## Testing

Run the tests for this module:

```
php artisan test --filter=AuthorTest
``` 
# Laravel Scramble API Documentation

This project uses [Laravel Scramble](https://github.com/dedoc/scramble) to generate API documentation based on OpenAPI annotations in the codebase.

## Accessing the Documentation

Once the server is running, you can access the API documentation at:

```
http://localhost:8000/docs/api
```

## Updating the Documentation

The API documentation is automatically generated from the OpenAPI annotations in the controllers. To add documentation to new endpoints:

1. Add OpenAPI annotations to your controller methods using PHP 8 attributes format
2. Follow the pattern in existing controllers like `AuthController` and `FaqController`
3. Run `php artisan scramble:export` to update the `api.json` file
4. Run `php artisan scramble:analyze` to verify there are no errors in the documentation

## Annotation Examples

### Controller Class

```php
#[OA\Tag(name: 'Authentication', description: 'API endpoints for user authentication')]
class AuthController extends Controller
{
    // Methods...
}
```

### Method Annotation

```php
#[OA\Post(
    path: '/api/v1/login',
    summary: 'Login a user',
    description: 'Authenticate a user and return a token'
)]
#[OA\RequestBody(
    required: true,
    content: new OA\JsonContent(
        properties: [
            new OA\Property(property: 'email', type: 'string', format: 'email', example: 'user@example.com'),
            new OA\Property(property: 'password', type: 'string', format: 'password', example: 'Password123!'),
            new OA\Property(property: 'remember_me', type: 'boolean', example: false)
        ]
    )
)]
#[OA\Response(
    response: 200,
    description: 'Login successful',
    content: new OA\JsonContent(
        properties: [
            new OA\Property(property: 'status', type: 'string', example: 'success'),
            new OA\Property(property: 'message', type: 'string', example: 'User logged in successfully'),
            new OA\Property(property: 'data', properties: [
                new OA\Property(property: 'user', type: 'object'),
                new OA\Property(property: 'access_token', type: 'string', example: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUz...'),
                new OA\Property(property: 'token_type', type: 'string', example: 'Bearer')
            ], type: 'object')
        ]
    )
)]
public function login(Request $request): JsonResponse
{
    // Method implementation...
}
```

## Configuration

The Scramble configuration is located in `config/scramble.php`. You can customize:

- API path and domain
- Documentation UI theme and features
- Authentication requirements for viewing documentation
- Server information and export path

## Security

By default, the API documentation is publicly accessible. To restrict access, uncomment the `RestrictedDocsAccess` middleware in `config/scramble.php` and customize it to your needs. 
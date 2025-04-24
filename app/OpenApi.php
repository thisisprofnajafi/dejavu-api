<?php

namespace App;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'DejaVu API Documentation',
    description: 'API documentation for DejaVu Backend',
)]

#[OA\Server(
    url: '/api',
    description: 'API Server'
)]

#[OA\Components(
    securitySchemes: [
        new OA\SecurityScheme(
            securityScheme: 'bearerAuth',
            type: 'http',
            scheme: 'bearer',
            bearerFormat: 'JWT',
            description: 'Enter JWT token in the format "Bearer {token}"'
        ),
    ]
)]

#[OA\Tag(
    name: 'Authentication',
    description: 'API endpoints for user authentication'
)]

#[OA\Tag(
    name: 'Module Auth',
    description: 'API endpoints for authentication in modules'
)]

#[OA\Tag(
    name: 'FAQs',
    description: 'API endpoints for FAQ management'
)]

#[OA\Tag(
    name: 'Settings',
    description: 'API endpoints for system settings management'
)]

#[OA\Tag(
    name: 'Pages',
    description: 'API endpoints for page management'
)]

#[OA\Tag(
    name: 'Users',
    description: 'API endpoints for user management'
)]

#[OA\Tag(
    name: 'Roles',
    description: 'API endpoints for role management'
)]

class OpenApi
{
} 
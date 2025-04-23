<?php

return [
    'name' => 'Auth',
    'token_lifetime' => [
        'access' => env('AUTH_ACCESS_TOKEN_LIFETIME', 60 * 24), // 1 day in minutes
        'refresh' => env('AUTH_REFRESH_TOKEN_LIFETIME', 60 * 24 * 7), // 1 week in minutes
    ],
    'default_roles' => [
        'admin' => [
            'name' => 'Admin',
            'permissions' => ['*'],
        ],
        'author' => [
            'name' => 'Author',
            'permissions' => [
                'create post',
                'edit post',
                'delete post',
                'create category',
                'view dashboard',
            ],
        ],
        'visitor' => [
            'name' => 'Visitor',
            'permissions' => [
                'view dashboard',
            ],
        ],
    ],
];

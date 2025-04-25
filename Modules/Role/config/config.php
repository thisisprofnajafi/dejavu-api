<?php

return [
    'name' => 'Role',
    
    /*
    |--------------------------------------------------------------------------
    | Role Settings
    |--------------------------------------------------------------------------
    */
    'role' => [
        // Default roles in the system
        'default_roles' => [
            'admin',
            'author',
            'visitor',
            'user',
            'customer'
        ],
        
        // Roles that cannot be deleted
        'protected_roles' => [
            'admin',
            'author',
            'visitor',
            'user',
            'customer'
        ],
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Permission Settings
    |--------------------------------------------------------------------------
    */
    'permission' => [
        // Default permissions in the system
        'default_permissions' => [
            // User permissions
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Role permissions
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            
            // Permission permissions
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',
        ],
        
        // Permissions that cannot be deleted
        'protected_permissions' => [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',
        ],
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Cache Settings
    |--------------------------------------------------------------------------
    */
    'cache' => [
        // Enable caching for roles and permissions
        'enabled' => true,
        
        // Cache expiration time in minutes
        'expiration' => 60,
    ],
];

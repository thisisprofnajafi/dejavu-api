<?php

namespace Modules\Role\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    // Extending the Spatie Role model to allow for future customization if needed
    
    /**
     * Get a list of all available permissions for a role
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function availablePermissions()
    {
        return Permission::all();
    }
} 
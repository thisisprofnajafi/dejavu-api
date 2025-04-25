<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run module seeders in correct order
        $this->call([
            \Modules\Role\Database\Seeders\RoleDatabaseSeeder::class,
            \Database\Seeders\UserSeeder::class,
            // \Database\Seeders\CategorySeeder::class,
            // \Database\Seeders\SupportSeeder::class,
            // \Database\Seeders\ContentSeeder::class,
        ]);
    }
}

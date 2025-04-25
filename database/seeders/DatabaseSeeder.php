<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Starting database seeding...');

        // Define seeders to run in order of dependency
        $seeders = [
            UserSeeder::class,
            // \Modules\Role\Database\Seeders\RoleDatabaseSeeder::class,
            // CategorySeeder::class,
            // SupportSeeder::class,
            // ContentSeeder::class,
        ];

        // Run each seeder with error handling
        foreach ($seeders as $seeder) {
            try {
                $this->command->info("Running $seeder...");
                $this->call($seeder);
            } catch (\Exception $e) {
                $this->command->error("Error running $seeder: " . $e->getMessage());
            }
        }

        $this->command->info('Database seeding completed successfully!');
    }
}

<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;

class AuthDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleAndPermissionSeeder::class);
    }
}

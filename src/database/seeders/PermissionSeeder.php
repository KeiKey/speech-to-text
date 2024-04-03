<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'create_listing',        'guard_name' => 'api'],
            ['name' => 'edit_listing',          'guard_name' => 'api'],
            ['name' => 'create_listing_review', 'guard_name' => 'api'],
            ['name' => 'work_listing',          'guard_name' => 'api']
        ];

        Permission::query()->insert($permissions);
    }
}

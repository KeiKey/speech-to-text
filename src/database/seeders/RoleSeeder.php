<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Role::query()
            ->create(['name' => 'auditor', 'guard_name' => 'api'])
            ->givePermissionTo(['create_listing', 'edit_listing', 'create_listing_assessment']);

        Role::query()
            ->create(['name' => 'inspector', 'guard_name' => 'api'])
            ->givePermissionTo(['work_listing']);
    }
}

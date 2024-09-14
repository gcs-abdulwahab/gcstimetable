<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin_role        = Role::create(['name' => 'sadmin']);
        $institute_admin_role   = Role::create(['name' => 'iadmin']);
        $department_admin_role  = Role::create(['name' => 'dadmin']);
    }
}

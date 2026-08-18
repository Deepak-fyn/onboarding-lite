<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view agents',
            'create agents',
            'update agents',
            'delete agents',

            'view documents',
            'upload documents',
            'verify documents',
            'reject documents',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }

        $superAdmin = Role::findByName('SuperAdmin');
        $admin = Role::findByName('Admin');
        $agent = Role::findByName('Agent');

        // SuperAdmin gets everything
        $superAdmin->syncPermissions($permissions);

        // Admin gets agent + document management
        $admin->syncPermissions([
            'view agents',
            'create agents',
            'update agents',

            'view documents',
            'verify documents',
            'reject documents',
        ]);

        // Agent can manage their own documents
        $agent->syncPermissions([
            'view documents',
            'upload documents',
        ]);
    }
}
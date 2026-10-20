<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'employees.view',
            'employees.create',
            'employees.edit',
            'employees.delete',
            'attendance.view',
            'attendance.manage',
            'leaves.view',
            'leaves.create',
            'leaves.approve',
            'reports.view',
            'settings.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $roles = [
            'HRD' => $permissions,

            'Manager' => [
                'employees.view',
                'attendance.view',
                'leaves.view',
                'leaves.approve',
                'reports.view',
            ],

            'Finance' => [
                'employees.view',
                'attendance.view',
                'reports.view',
            ],

            'Employee' => [
                'attendance.view',
                'leaves.view',
                'leaves.create',
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);

            $role->syncPermissions($rolePermissions);
        }
    }
}
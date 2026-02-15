<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            'customers',
            'quotes',
            'suppliers',
            'purchases',
            'products',
            'stock',
            'projects',
            'tasks',
            'files',
            'bom',
            'users',
            'settings',
        ];

        // Admin - Full access
        foreach ($modules as $module) {
            Permission::create([
                'role' => 'admin',
                'module' => $module,
                'can_view' => true,
                'can_create' => true,
                'can_edit' => true,
                'can_delete' => true,
            ]);
        }

        // Manager - Most access, no user/settings management
        foreach ($modules as $module) {
            if (in_array($module, ['users', 'settings'])) {
                Permission::create([
                    'role' => 'manager',
                    'module' => $module,
                    'can_view' => true,
                    'can_create' => false,
                    'can_edit' => false,
                    'can_delete' => false,
                ]);
            } else {
                Permission::create([
                    'role' => 'manager',
                    'module' => $module,
                    'can_view' => true,
                    'can_create' => true,
                    'can_edit' => true,
                    'can_delete' => false,
                ]);
            }
        }

        // Staff - Limited access
        foreach ($modules as $module) {
            if (in_array($module, ['users', 'settings', 'suppliers', 'bom'])) {
                Permission::create([
                    'role' => 'staff',
                    'module' => $module,
                    'can_view' => false,
                    'can_create' => false,
                    'can_edit' => false,
                    'can_delete' => false,
                ]);
            } else {
                Permission::create([
                    'role' => 'staff',
                    'module' => $module,
                    'can_view' => true,
                    'can_create' => in_array($module, ['quotes', 'purchases', 'stock']),
                    'can_edit' => in_array($module, ['quotes', 'tasks']),
                    'can_delete' => false,
                ]);
            }
        }
    }
}

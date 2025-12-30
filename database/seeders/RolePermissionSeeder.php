<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Clear permission cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | Create Permissions
        |--------------------------------------------------------------------------
        */
        $permissions = [
            'employees.view',
            'employees.create',
            'employees.edit',
            'employees.delete',
            'user.dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Create Roles (SAFE)
        |--------------------------------------------------------------------------
        */
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $employeeRole = Role::firstOrCreate([
            'name' => 'employee',
            'guard_name' => 'web',
        ]);
        $userDashboardRole = Role::firstOrCreate([
            'name' => 'UserDashboard',
            'guard_name' => 'web'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Assign Permissions
        |--------------------------------------------------------------------------
        */
        // Admin gets all permissions
        $adminRole->syncPermissions(Permission::all());
        // userDashboard gets only user.dashboard   permissions
        $userDashboardRole->givePermissionTo('user.dashboard');
        // Employee gets all permissions except delete
        $employeeRole->syncPermissions(
            Permission::where('name', '!=', 'employees.delete')->get()
        );
        //|--------------------------------------------------------------------------
        //| Assign Admin Role to User ID = 1
        //|--------------------------------------------------------------------------
        //*/
        $user = User::find(1);
        if ($user) {
            $user->syncRoles(['admin']);
        }
        $user = User::find(2);
        if ($user) {
            $user->syncRoles(['employee']);
        }
        $user = User::find(3);
        if ($user) {
            $user->syncRoles(['userDashboard']);
        }
    }
}

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
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ১. পারমিশন তৈরি (আপনার ডাটাবেস স্ক্রিনশট অনুযায়ী)
        $permissions = [
            'employees.view',
            'employees.create',
            'employees.edit',
            'employees.delete',
            'employees.index',
            'user.dashboard',
            'employees.approve'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // ২. রোল তৈরি (আপনার roles টেবিলের হুবহু নাম অনুযায়ী)
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $employeeRole = Role::firstOrCreate(['name' => 'employee', 'guard_name' => 'web']);
        $userDashboardRole = Role::firstOrCreate(['name' => 'UserDashboard', 'guard_name' => 'web']);
        $stuffRole = Role::firstOrCreate(['name' => 'stuff', 'guard_name' => 'web']);

        // ৩. পারমিশন এসাইন করা
        $adminRole->syncPermissions(Permission::all());

        $userDashboardRole->syncPermissions(['user.dashboard']);
        $stuffRole->syncPermissions(['employees.view', 'employees.index']);
        $employeePerms = Permission::whereNotIn('name', ['employees.approve', 'employees.delete'])->get();
        $employeeRole->syncPermissions($employeePerms);

        // ৪. ইউজারদের রোল এসাইন করা এবং Admin কে Approve করা
        $user1 = User::find(1);
        if ($user1) {
            $user1->syncRoles(['admin']);
            $user1->update(['is_approved' => true]); // অ্যাডমিন নিজে এপ্রুভড
        }

        $user2 = User::find(2);
        if ($user2) {
            $user2->syncRoles(['employee']);
        }

        $user3 = User::find(3);
        if ($user3) {
            $user3->syncRoles(['UserDashboard']);
        }
    }
}

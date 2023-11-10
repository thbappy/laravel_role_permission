<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // permission
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $admin = Permission::all();
        $manager      = Permission::whereIn('name',['user-list','user-create','user-edit','user-delete','permission-list','role-list'])->get();
        $employee    = Permission::whereIn('name',['user-list','permission-list','role-list'])->get();

        // Admin
        $_admin = new Role();
        $_admin->name = "Admin";
        $_admin->save();
        $_admin->syncPermissions($admin);

        // Admin
        $_manager = new Role();
        $_manager->name = "Manager";
        $_manager->save();
        $_manager->syncPermissions($manager);

        // General
        $_employee = new Role();
        $_employee->name = "Employee";
        $_employee->save();
        $_employee->syncPermissions($employee);


        $admin_info = new User();
        $admin_info->name = 'Tanbeer';
        $admin_info->email = 'admin@gmail.com';
        $admin_info->password = bcrypt('password');
        $admin_info->remember_token = Str::random(10);
        $admin_info->save();
        $admin_info->assignRole('Admin');

        $manager_info = new User();
        $manager_info->name = 'Manager';
        $manager_info->email = 'manager@gmail.com';
        $manager_info->password = bcrypt('password');
        $manager_info->remember_token = Str::random(10);
        $manager_info->save();
        $manager_info->assignRole('Manager');

        $employee_info = new User();
        $employee_info->name = 'Employee';
        $employee_info->email = 'employee@gmail.com';
        $employee_info->password = bcrypt('password');
        $employee_info->remember_token = Str::random(10);
        $employee_info->save();
        $employee_info->assignRole('Employee');



    }
}

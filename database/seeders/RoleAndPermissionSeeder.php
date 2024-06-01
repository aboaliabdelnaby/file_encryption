<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions=[
            'admin.home',
            'admin.index',
            'admin.create',
            'admin.edit',
            'admin.delete',
            'admin.room.index',
            'admin.room.create',
            'admin.room.edit',
            'admin.room.delete',
            'admin.request.index',
            'admin.request.actions',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name'=>$permission,'guard_name' => 'admin']);
        }

        // Create roles
        $admin = Role::firstOrCreate(['name'=>'admin','guard_name' => 'admin']);
        $employee = Role::firstOrCreate(['name'=>'employee','guard_name' => 'admin']);

        // Give permission to certain role
        foreach ($permissions as $permission) {
            $admin->givePermissionTo([$permission]);
        }
        $employee->givePermissionTo(['admin.request.index','admin.request.actions']);

        // Assign role to user
        Admin::first()->assignRole(['admin']);
    }
}

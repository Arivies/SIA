<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1=Role::create(['name'=> 'admin']);
        $role2=Role::create(['name'=> 'invitado']);

        $list_user = Permission::create(['name' => 'users.index']);
        $create_user= Permission::create(['name' => 'users.create']);
        $edit_user = Permission::create(['name' => 'users.edit']);
        $show_user = Permission::create(['name' => 'users.show']);
        $delete_user = Permission::create(['name' => 'users.destroy']);

        $list_role  = Permission::create(['name' => 'roles.index']);
        $create_role = Permission::create(['name' => 'roles.create']);
        $edit_role  = Permission::create(['name' => 'roles.edit']);
        $show_role  = Permission::create(['name' => 'roles.show']);
        $delete_role = Permission::create(['name' =>'roles.destroy']);

        $list_permission   = Permission::create(['name' => 'permissions.index']);
        $create_permission = Permission::create(['name' => 'permissions.create']);
        $edit_permission   = Permission::create(['name' => 'permissions.edit']);
        $show_permission   = Permission::create(['name' => 'permissions.show']);
        $delete_permission = Permission::create(['name' => 'permissions.destroy']);

        $role1->syncPermissions([$list_user,$create_user,$edit_user,$show_user,$delete_user,
                                $list_role,$create_role,$edit_role,$show_role,$delete_role,
                                $list_permission,$create_permission,$edit_permission,$show_permission,$delete_permission ]);

        $role2->syncPermissions([$list_user,$show_user]);
    }
}

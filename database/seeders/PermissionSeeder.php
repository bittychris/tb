<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->delete();            
            
        $data = array(
            0 =>
                array(
                    'name' => 'roles and permissions menu',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            1 =>
                array(
                    'name' => 'all roles',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            2 =>
                array(
                    'name' => 'add role',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            3 =>
                array(
                    'name' => 'edit role',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            4 =>
                array(
                    'name' => 'delete role',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            5 =>
                array(
                    'name' => 'all permissions',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),   
            6 =>
                array(
                    'name' => 'add permission',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            7 =>
                array(
                    'name' => 'edit permission',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            8 =>
                array(
                    'name' => 'delete permission',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            9 =>
                array(
                    'name' => 'roles with permissions',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ), 
            10 =>
                array(
                    'name' => 'assign permissions to role',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            11 =>
                array(
                    'name' => 'edit assigned permissions to role',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            12 =>
                array(
                    'name' => 'delete roles permissions',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ), 
            13 =>
                array(
                    'name' => 'admins and staffs menu',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            14 =>
                array(
                    'name' => 'all admins',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            15 =>
                array(
                    'name' => 'add admin',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            16 =>
                array(
                    'name' => 'edit admin',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            17 =>
                array(
                    'name' => 'delete admin',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            18 =>
                array(
                    'name' => 'all staffs',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),   
            19 =>
                array(
                    'name' => 'add staff',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            20 =>
                array(
                    'name' => 'edit staff',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            21 =>
                array(
                    'name' => 'delete staff',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            22 =>
                array(
                    'name' => 'all age groups',
                    'guard_name' => 'web',
                    'group_name' => 'age group',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),   
            23 =>
                array(
                    'name' => 'add age group',
                    'guard_name' => 'web',
                    'group_name' => 'age group',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            24 =>
                array(
                    'name' => 'edit age group',
                    'guard_name' => 'web',
                    'group_name' => 'age group',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            25 =>
                array(
                    'name' => 'delete age group',
                    'guard_name' => 'web',
                    'group_name' => 'age group',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            26 =>
                array(
                    'name' => 'all attributes',
                    'guard_name' => 'web',
                    'group_name' => 'attribute',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),   
            27 =>
                array(
                    'name' => 'add attribute',
                    'guard_name' => 'web',
                    'group_name' => 'attribute',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            28 =>
                array(
                    'name' => 'edit attribute',
                    'guard_name' => 'web',
                    'group_name' => 'attribute',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            29 =>
                array(
                    'name' => 'delete attribute',
                    'guard_name' => 'web',
                    'group_name' => 'attribute',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            30 =>
                array(
                    'name' => 'all form attributes',
                    'guard_name' => 'web',
                    'group_name' => 'form attribute',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),   
            31 =>
                array(
                    'name' => 'add form attribute',
                    'guard_name' => 'web',
                    'group_name' => 'form attribute',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            32 =>
                array(
                    'name' => 'edit form attribute',
                    'guard_name' => 'web',
                    'group_name' => 'form attribute',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            33 =>
                array(
                    'name' => 'delete form attribute',
                    'guard_name' => 'web',
                    'group_name' => 'form attribute',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            34 =>
                array(
                    'name' => 'all field data',
                    'guard_name' => 'web',
                    'group_name' => 'field data',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),   
            35 =>
                array(
                    'name' => 'add field data',
                    'guard_name' => 'web',
                    'group_name' => 'field data',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            36 =>
                array(
                    'name' => 'edit field data',
                    'guard_name' => 'web',
                    'group_name' => 'field data',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            37 =>
                array(
                    'name' => 'recycle bin menu',
                    'guard_name' => 'web',
                    'group_name' => 'recycle bin',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            38 =>
                array(
                    'name' => 'all deleted admins',
                    'guard_name' => 'web',
                    'group_name' => 'recycle bin',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            39 =>
                array(
                    'name' => 'restore admin',
                    'guard_name' => 'web',
                    'group_name' => 'recycle bin',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            40 =>
                array(
                    'name' => 'all deleted staffs',
                    'guard_name' => 'web',
                    'group_name' => 'recycle bin',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            41 =>
                array(
                    'name' => 'restore staff',
                    'guard_name' => 'web',
                    'group_name' => 'recycle bin',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            42 =>
                array(
                    'name' => 'view notifications',
                    'guard_name' => 'web',
                    'group_name' => 'notifications',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),     
            43 =>
                array(
                    'name' => 'all reports',
                    'guard_name' => 'web',
                    'group_name' => 'reports',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ), 
            // 44 =>
            //     array(
            //         'name' => 'view reports',
            //         'guard_name' => 'web',
            //         'group_name' => 'reports',
            //         'created_at' => Carbon::now(),
            //         'updated_at' => Carbon::now(),
            //     ),
            45 =>
                array(
                    'name' => 'download reports',
                    'guard_name' => 'web',
                    'group_name' => 'reports',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            46 =>
                array(
                    'name' => 'submit field data',
                    'guard_name' => 'web',
                    'group_name' => 'field data',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            );
        
        foreach ($data as $item) {

            Permission::create($item);

        }
        
        $role = Role::findByName('Admin');
        $permissions = Permission::all();
        
        foreach ($permissions as $item) {
            DB::table('role_has_permissions')->insert([
               'role_id' => $role->id,
               'permission_id' => $item->id,
            ]);
            
        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
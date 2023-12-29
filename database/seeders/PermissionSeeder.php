<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            
        DB::table('permissions')->insert(array(
            0 =>
                array(
                    //'id' => 1,
                    'name' => 'roles and permissions menu',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            1 =>
                array(
                    //'id' => 2,
                    'name' => 'all roles',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            2 =>
                array(
                    //'id' => 3,
                    'name' => 'add role',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            3 =>
                array(
                    //'id' => 4,
                    'name' => 'edit role',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            4 =>
                array(
                    //'id' => 5,
                    'name' => 'delete role',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            5 =>
                array(
                    //'id' => 6,
                    'name' => 'all permissions',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),   
            6 =>
                array(
                    //'id' => 7,
                    'name' => 'add permission',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            7 =>
                array(
                    //'id' => 8,
                    'name' => 'edit permission',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            8 =>
                array(
                    //'id' => 9,
                    'name' => 'delete permission',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            9 =>
                array(
                    //'id' => 10,
                    'name' => 'roles with permissions',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ), 
            10 =>
                array(
                    //'id' => 11,
                    'name' => 'assign permissions to role',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            11 =>
                array(
                    //'id' => 12,
                    'name' => 'edit assigned permissions to role',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            12 =>
                array(
                    //'id' => 13,
                    'name' => 'delete roles permissions',
                    'guard_name' => 'web',
                    'group_name' => 'roles and permissions',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ), 
            13 =>
                array(
                    //'id' => 14,
                    'name' => 'admins and staffs menu',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            14 =>
                array(
                    //'id' => 15,
                    'name' => 'all admins',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            15 =>
                array(
                    //'id' => 16,
                    'name' => 'add admin',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            16 =>
                array(
                    //'id' => 17,
                    'name' => 'edit admin',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            17 =>
                array(
                    //'id' => 18,
                    'name' => 'delete admin',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            18 =>
                array(
                    //'id' => 19,
                    'name' => 'all staffs',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),   
            19 =>
                array(
                    //'id' => 20,
                    'name' => 'add staff',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            20 =>
                array(
                    //'id' => 21,
                    'name' => 'edit staff',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            21 =>
                array(
                    //'id' => 22,
                    'name' => 'delete staff',
                    'guard_name' => 'web',
                    'group_name' => 'admins and staffs',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            22 =>
                array(
                    //'id' => 23,
                    'name' => 'all age groups',
                    'guard_name' => 'web',
                    'group_name' => 'age group',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),   
            23 =>
                array(
                    //'id' => 24,
                    'name' => 'add age group',
                    'guard_name' => 'web',
                    'group_name' => 'age group',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            24 =>
                array(
                    //'id' => 25,
                    'name' => 'edit age group',
                    'guard_name' => 'web',
                    'group_name' => 'age group',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            25 =>
                array(
                    //'id' => 26,
                    'name' => 'delete age group',
                    'guard_name' => 'web',
                    'group_name' => 'age group',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            26 =>
                array(
                    //'id' => 27,
                    'name' => 'all attributes',
                    'guard_name' => 'web',
                    'group_name' => 'attribute',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),   
            27 =>
                array(
                    //'id' => 28,
                    'name' => 'add attribute',
                    'guard_name' => 'web',
                    'group_name' => 'attribute',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            28 =>
                array(
                    //'id' => 29,
                    'name' => 'edit attribute',
                    'guard_name' => 'web',
                    'group_name' => 'attribute',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            29 =>
                array(
                    //'id' => 30,
                    'name' => 'delete attribute',
                    'guard_name' => 'web',
                    'group_name' => 'attribute',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            30 =>
                array(
                    //'id' => 31,
                    'name' => 'all form attributes',
                    'guard_name' => 'web',
                    'group_name' => 'form attribute',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),   
            31 =>
                array(
                    //'id' => 32,
                    'name' => 'add form attribute',
                    'guard_name' => 'web',
                    'group_name' => 'form attribute',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            32 =>
                array(
                    //'id' => 33,
                    'name' => 'edit form attribute',
                    'guard_name' => 'web',
                    'group_name' => 'form attribute',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            33 =>
                array(
                    //'id' => 34,
                    'name' => 'delete form attribute',
                    'guard_name' => 'web',
                    'group_name' => 'form attribute',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            34 =>
                array(
                    //'id' => 35,
                    'name' => 'all field data',
                    'guard_name' => 'web',
                    'group_name' => 'field data',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),   
            35 =>
                array(
                    //'id' => 36,
                    'name' => 'add field data (report)',
                    'guard_name' => 'web',
                    'group_name' => 'field data',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            36 =>
                array(
                    //'id' => 37,
                    'name' => 'edit field data (report)',
                    'guard_name' => 'web',
                    'group_name' => 'field data',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            // 37 =>
            //     array(
            //         //'id' => 38,
            //         'name' => 'delete field data (report)',
            //         'guard_name' => 'web',
            //         'group_name' => 'field data',
            //         'created_at' => Carbon::now(),
            //         'updated_at' => Carbon::now(),
            //     ),
            37 =>
                array(
                    //'id' => 38,
                    'name' => 'recycle bin menu',
                    'guard_name' => 'web',
                    'group_name' => 'recycle bin',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            38 =>
                array(
                    //'id' => 39,
                    'name' => 'all deleted admins',
                    'guard_name' => 'web',
                    'group_name' => 'recycle bin',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            39 =>
                array(
                    //'id' => 40,
                    'name' => 'restore admin',
                    'guard_name' => 'web',
                    'group_name' => 'recycle bin',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            // 40 =>
            //     array(
            //         //'id' => 41,
            //         'name' => 'delete admin completely',
            //         'guard_name' => 'web',
            //         'group_name' => 'recycle bin',
            //         'created_at' => Carbon::now(),
            //         'updated_at' => Carbon::now(),
            //     ),
            40 =>
                array(
                    //'id' => 41,
                    'name' => 'all deleted staffs',
                    'guard_name' => 'web',
                    'group_name' => 'recycle bin',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            41 =>
                array(
                    //'id' => 42,
                    'name' => 'restore staff',
                    'guard_name' => 'web',
                    'group_name' => 'recycle bin',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            // 42 =>
            //     array(
            //         //'id' => 43,
            //         'name' => 'delete staff completely',
            //         'guard_name' => 'web',
            //         'group_name' => 'recycle bin',
            //         'created_at' => Carbon::now(),
            //         'updated_at' => Carbon::now(),
            //     ),      
        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->delete();            

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Regional coordinator']);
        Role::create(['name' => 'AMREF personnel']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
    }
}

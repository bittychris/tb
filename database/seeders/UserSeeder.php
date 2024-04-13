<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->delete();

        $role = Role::findByName('Admin');
        
        $region = Region::find(2);

        DB::table('users')->insert(array (
            0 =>
                array (
                     'id' => 1,
                    'first_name' => 'Juma',
                     'last_name' => 'John',
                     'phone' => '+255 789 435 676',
                     'email' => 'admin@gmail.com',
                     'password' => bcrypt('Admin'),
                     'role_id' => $role->id,
                     'region_id' => $region->id,
                     'remember_token' => Str::random(60),
                     'created_at' => Carbon::now(),
                     'updated_at' => Carbon::now(),
                    ),

                // 1 =>
                // array (
                //     'id' => 2,

                //      'first_name'           => 'Juma',
                //      'last_name'           => 'John',
                //      'phone'           => '+255 789 435 676',
                //      'email'          => 'rc@gmail.com',
                //      'password'       => bcrypt('Rc'),
                //      'role_id'       => 2,
                //      'remember_token' => Str::random(60),
                //      'created_at' => Carbon::now(),
                //      'updated_at' => Carbon::now(),
                // ),
                // 2 =>
                // array (
                //     'id' => 3,

                //      'first_name'           => 'Juma',
                //      'last_name'           => 'John',
                //      'phone'           => '+255 789 435 676',
                //      'email'          => 'amref@gmail.com',
                //      'password'       => bcrypt('Amref'),
                //      'role_id'       => 3,
                //      'remember_token' => Str::random(60),
                //      'created_at' => Carbon::now(),
                //      'updated_at' => Carbon::now(),
                // ),
                // 3 =>
                // array (
                //     'id' => 4,

                //      'first_name'           => 'Juma',
                //      'last_name'           => 'John',
                //      'phone'           => '+255 789 435 676',
                //      'email'          => 'health@gmail.com',
                //      'password'       => bcrypt('Health'),
                //      'role_id'       => 3,
                //      'remember_token' => Str::random(60),
                //      'created_at' => Carbon::now(),
                //      'updated_at' => Carbon::now(),
                // ),


            ));
            
            $user = User::latest()->first();
            $user->assignRole($role->name);

            $permissions = DB::table('role_has_permissions')->where('role_id', $role->id)->get();

            foreach($permissions as $permission) {
                DB::table('model_has_permissions')->insert([
                    'permission_id' => $permission->permission_id,
                    'model_id' => $user->id,
                    'model_type' => 'App\Models\User'
                ]);

            }
            
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
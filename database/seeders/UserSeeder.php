<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->delete();

        DB::table('users')->insert(array (
            0 =>
                array (
                    'id' => 1,

                     'first_name'           => 'Juma',
                     'last_name'           => 'John',
                     'phone'           => '+255 789 435 676',
                     'email'          => 'admin@gmail.com',
                     'password'       => bcrypt('Admin'),
                     'role_id'       => 1,
                     'remember_token' => Str::random(60),
                     'created_at' => Carbon::now(),
                     'updated_at' => Carbon::now(),
                    ),

                1 =>
                array (
                    'id' => 2,

                     'first_name'           => 'Juma',
                     'last_name'           => 'John',
                     'phone'           => '+255 789 435 676',
                     'email'          => 'rc@gmail.com',
                     'password'       => bcrypt('Rc'),
                     'role_id'       => 2,
                     'remember_token' => Str::random(60),
                     'created_at' => Carbon::now(),
                     'updated_at' => Carbon::now(),
                ),
                2 =>
                array (
                    'id' => 3,

                     'first_name'           => 'Juma',
                     'last_name'           => 'John',
                     'phone'           => '+255 789 435 676',
                     'email'          => 'amref@gmail.com',
                     'password'       => bcrypt('Amref'),
                     'role_id'       => 3,
                     'remember_token' => Str::random(60),
                     'created_at' => Carbon::now(),
                     'updated_at' => Carbon::now(),
                ),
                3 =>
                array (
                    'id' => 4,

                     'first_name'           => 'Juma',
                     'last_name'           => 'John',
                     'phone'           => '+255 789 435 676',
                     'email'          => 'health@gmail.com',
                     'password'       => bcrypt('Health'),
                     'role_id'       => 3,
                     'remember_token' => Str::random(60),
                     'created_at' => Carbon::now(),
                     'updated_at' => Carbon::now(),
                ),


            ));
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }




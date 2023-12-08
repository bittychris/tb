<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        if (User::count() == 0) {

            User::create([
                'first_name'     => 'Juma',
                'last_name'      => 'Hashim',
                'phone'          => '+255 789 435 676',
                'email'          => 'admin@gmail.com',
                'password'       => bcrypt('Admin'),
                'remember_token' => Str::random(60),
                'role_id'        => ''
            ])->assignRole('');
        }
    }

}

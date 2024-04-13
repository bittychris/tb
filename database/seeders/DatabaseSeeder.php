<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\WardSeeder;
use Database\Seeders\RegionSeeder;
use Database\Seeders\DistrictSeeder;
use Database\Seeders\PermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(WardSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(AttributeSeeder::class);
        
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AgeGroup;

class ageGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        AgeGroup::create([
                'slug' => '0-5',
                'min_age' => 0,
                'max_age' => 5,
            ]);

        AgeGroup::create([
                'slug' => '6-14',
                'min_age' => 6,
                'max_age' => 14,
            ]);

        AgeGroup::create([
                'slug' => '15 & Above',
                'min_age' => 15,
                'max_age' => 100,
            ]);
            
    }
}

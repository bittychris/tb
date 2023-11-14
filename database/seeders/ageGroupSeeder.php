<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ageGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        AgeGroup::create(
            [
                'slug' => '0-5',
                'min_age' => 0,
                'max_age' => 5,
            ],
            [
                'slug' => '6-14',
                'min_age' => 6,
                'max_age' => 14,
            ],
            [
                'slug' => '15 & Above',
                'min_age' => 15,
                'max_age' => 100,
            ]
        );
    }
}

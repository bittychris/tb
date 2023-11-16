<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        District::create ([
            'name' => 'Ilala',
            'region_id' => 1
        ],
        [
            'name' => 'Kinondoni',
            'region_id' => 1
        ],
        
        [
            'name' => 'Nyamagana',
            'region_id' => 2

        ],
        [
            'name' => 'Temeke',
            'region_id' => 1

        ]

        );

    }
}

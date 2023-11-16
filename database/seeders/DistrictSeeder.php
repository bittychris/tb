<?php

namespace Database\Seeders;

use App\Models\district;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        district::create ([
            'name' => 'Ilala',
            'region_id' => 1
        ]);

        district::create ([
            'name' => 'Kinondoni',
            'region_id' => 1
        ]);

        district::create ([
            'name' => 'Nyamagana',
            'region_id' => 2

        ]);

        district::create ([
            'name' => 'Temeke',
            'region_id' => 1

        ]);

    }
}

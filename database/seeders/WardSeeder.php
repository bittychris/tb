<?php

namespace Database\Seeders;

use App\Models\ward;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ward::create ([
            'name' => 'Mnazi mmoja',
            'district_id' => 1
        ]);

        ward::create([
            'name' => 'Kawe',
            'district_id' => 2
        ]);
        
        ward::create([
            'name' => 'Msasani',
            'district_id' => 2

        ]);
        
        ward::create([
            'name' => 'Kariakoo',
            'district_id' => 1
        ]);

    }
}

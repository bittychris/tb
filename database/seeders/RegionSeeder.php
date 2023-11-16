<?php

namespace Database\Seeders;

use App\Models\region;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        region::create ([
            'name' => 'Dar es Salaam'
        ]);

        region::create ([
            'name' => 'Mwanza'
        ]);

        region::create ([
            'name' => 'Arusha'
        ]);

        region::create ([
            'name' => 'Morogoro'
        ]);

        region::create ([
            'name' => 'Kigoma'
        ]);

        region::create ([
            'name' => 'Morogoro'
        ]);

        region::create ([
            'name' => 'Ruvuma'
        ]);

        region::create ( [
            'name' => 'Tanga'
        ]);

        region::create ([
            'name' => 'Dodoma'
        ]);

        region::create ([
            'name' => 'Mtwara'
        ]);

        region::create ([
            'name' => 'Lindi'
        ]);

        region::create ([
            'name' => 'Njombe'
        ]);

        region::create ([
            'name' => 'Songwe'
        ]);

        region::create ([
            'name' => 'Mbeya'
        ]);        

        region::create ([
            'name' => 'Rukwa'
        ]);

        region::create ([
            'name' => 'Iringa'
        ]);

        region::create ([
            'name' => 'Pwani'
        ]);

        region::create ([
            'name' => 'Katavi'
        ]);

        region::create ([
            'name' => 'Singida'
        ]);

        region::create ([
            'name' => 'Tabora'
        ]);

        region::create ([
            'name' => 'Manyara'
        ]);

        region::create ([
            'name' => 'Kilimanjaro'
        ]);

        region::create ([
            'name' => 'Shinyanga'
        ]);

        region::create ([
            'name' => 'Geita'
        ]);

        region::create ([
            'name' => 'Simiyu'
        ]);

        region::create ([
            'name' => 'Mara'
        ]);

        region::create ([
            'name' => 'Kagera'
        ]);

    }
}

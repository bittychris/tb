<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //disable foreign key check for this connection before running seeders
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('attributes')->delete();            
        
        DB::table('attributes')->insert(array (
        // $data = array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'Number of individual received TB health Education (estimated number  in hot spot area)',
                    'attribute_no' => 'A1',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'Number of individual screened for TB ',
                    'attribute_no' => 'A2',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'Number of presumptive TB identified',
                    'attribute_no' => 'A3',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'roles and permissions menu',
                    'attribute_no' => 'a4',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'Number of Presumptive TB referred ',
                    'attribute_no' => 'A5',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => 'Number of presumptive TB tested ',
                    'attribute_no' => 'A6',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            6 =>
                array(
                    'id' => 7,
                    'name' => 'Number confirmed TB by GeneXpert ',
                    'attribute_no' => 'A7',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            7 =>
                array(
                    'id' => 8,
                    'name' => 'Number confirmed TB  by TrueNat',
                    'attribute_no' => 'A8',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            8 =>
                array(
                    'id' => 9,
                    'name' => 'Number confirmed TB by smear microscopy',
                    'attribute_no' => 'A9',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            9 =>
                array(
                    'id' => 10,
                    'name' => 'Number confirmed TB by Chest X-ray',
                    'attribute_no' => 'A10',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            10 =>
                array(
                    'id' => 11,
                    'name' => 'Number confirmed TB by using Ped TB score chart',
                    'attribute_no' => 'A11',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            11 =>
                array(
                    'id' => 12,
                    'name' => 'Number confirmed TB by clinically diagnosis',
                    'attribute_no' => 'A12',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            12 =>
                array(
                    'id' => 13,
                    'name' => 'Number of individual confirmed TB',
                    'attribute_no' => 'A13',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            13 =>
                array(
                    'id' => 14,
                    'name' => 'roles and permissions menu',
                    'attribute_no' => 'A14',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            14 =>
                array(
                    'id' => 15,
                    'name' => 'Number of individual confirmed MDR TB (sub set of total number confirmed TB)',
                    'attribute_no' => 'A15',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            15 =>
                array(
                    'id' => 16,
                    'name' => 'Number of individual started anti-TB medication',
                    'attribute_no' => 'A16',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            16 =>
                array(
                    'id' => 17,
                    'name' => 'Number confirmed TB know their HIV status',
                    'attribute_no' => 'A17',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            ));

        // foreach ($data as $item) {

        //     Attribute::create($item);

        // }
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
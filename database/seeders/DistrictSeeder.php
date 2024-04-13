<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('districts')->delete();

        DB::table('districts')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'region_id' => 1,
                    'name' => 'ARUSHA MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            1 =>
                array (
                    'id' => 2,
                    'region_id' => 1,
                    'name' => 'KARATU',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            2 =>
                array (
                    'id' => 3,
                    'region_id' => 1,
                    'name' => 'LONGIDO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            3 =>
                array (
                    'id' => 4,
                    'region_id' => 1,
                    'name' => 'MERU',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            4 =>
                array (
                    'id' => 5,
                    'region_id' => 1,
                    'name' => 'MONDULI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            5 =>
                array (
                    'id' => 6,
                    'region_id' => 1,
                    'name' => 'NGORONGORO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            6 =>
                array (
                    'id' => 7,
                    'region_id' => 2,
                    'name' => 'ILALA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            7 =>
                array (
                    'id' => 8,
                    'region_id' => 2,
                    'name' => 'KINONDONI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            8 =>
                array (
                    'id' => 9,
                    'region_id' => 2,
                    'name' => 'TEMEKE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            9 =>
                array (
                    'id' => 10,
                    'region_id' => 2,
                    'name' => 'KINONDONI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            10 =>
                array (
                    'id' => 11,
                    'region_id' => 2,
                    'name' => 'KINONDONI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            11 =>
                array (
                    'id' => 12,
                    'region_id' => 3,
                    'name' => 'BAHI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            12 =>
                array (
                    'id' => 13,
                    'region_id' => 3,
                    'name' => 'CHAMWINO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            13 =>
                array (
                    'id' => 14,
                    'region_id' => 3,
                    'name' => 'CHEMBA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            14 =>
                array (
                    'id' => 15,
                    'region_id' => 3,
                    'name' => 'DODOMA MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            15 =>
                array (
                    'id' => 16,
                    'region_id' => 3,
                    'name' => 'KONDOA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            16 =>
                array (
                    'id' => 17,
                    'region_id' => 3,
                    'name' => 'KONGWA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            17 =>
                array (
                    'id' => 18,
                    'region_id' => 3,
                    'name' => 'MPWAPWA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            18 =>
                array (
                    'id' => 19,
                    'region_id' => 4,
                    'name' => 'BUKOMBE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            19 =>
                array (
                    'id' => 20,
                    'region_id' => 4,
                    'name' => 'CHATO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            20 =>
                array (
                    'id' => 21,
                    'region_id' => 4,
                    'name' => 'GEITA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            21 =>
                array (
                    'id' => 22,
                    'region_id' => 4,
                    'name' => 'MBONGWE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            22 =>
                array (
                    'id' => 23,
                    'region_id' => 4,
                    'name' => 'NYANG\'HWALE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            23 =>
                array (
                    'id' => 24,
                    'region_id' => 5,
                    'name' => 'IRINGA MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            24 =>
                array (
                    'id' => 25,
                    'region_id' => 5,
                    'name' => 'KILOLO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            25 =>
                array (
                    'id' => 26,
                    'region_id' => 5,
                    'name' => 'IRINGA MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            26 =>
                array (
                    'id' => 27,
                    'region_id' => 5,
                    'name' => 'MUFINDI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            27 =>
                array (
                    'id' => 28,
                    'region_id' => 6,
                    'name' => 'BIHARAMULO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            28 =>
                array (
                    'id' => 29,
                    'region_id' => 6,
                    'name' => 'BUKOBA MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            29 =>
                array (
                    'id' => 30,
                    'region_id' => 6,
                    'name' => 'KARAGWE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            30 =>
                array (
                    'id' => 31,
                    'region_id' => 6,
                    'name' => 'KYERWA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            31 =>
                array (
                    'id' => 32,
                    'region_id' => 6,
                    'name' => 'MISSENYI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            32 =>
                array (
                    'id' => 33,
                    'region_id' => 6,
                    'name' => 'MULEBA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            33 =>
                array (
                    'id' => 34,
                    'region_id' => 6,
                    'name' => 'NGARA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            34 =>
                array (
                    'id' => 35,
                    'region_id' => 7,
                    'name' => 'MLELE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            35 =>
                array (
                    'id' => 36,
                    'region_id' => 7,
                    'name' => 'MPANDA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            36 =>
                array (
                    'id' => 37,
                    'region_id' => 8,
                    'name' => 'BUHIGWE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            37 =>
                array (
                    'id' => 38,
                    'region_id' => 8,
                    'name' => 'KAKONKO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            38 =>
                array (
                    'id' => 39,
                    'region_id' => 8,
                    'name' => 'KASULU MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            39 =>
                array (
                    'id' => 40,
                    'region_id' => 8,
                    'name' => 'KASULU MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            40 =>
                array (
                    'id' => 41,
                    'region_id' => 8,
                    'name' => 'KIBONDO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            41 =>
                array (
                    'id' => 42,
                    'region_id' => 8,
                    'name' => 'KIGOMA MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            42 =>
                array (
                    'id' => 43,
                    'region_id' => 8,
                    'name' => 'UVINZA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            43 =>
                array (
                    'id' => 44,
                    'region_id' => 9,
                    'name' => 'HAI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            44 =>
                array (
                    'id' => 45,
                    'region_id' => 9,
                    'name' => 'MOSHI MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            45 =>
                array (
                    'id' => 46,
                    'region_id' => 9,
                    'name' => 'MWANGA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            46 =>
                array (
                    'id' => 47,
                    'region_id' => 9,
                    'name' => 'ROMBO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            47 =>
                array (
                    'id' => 48,
                    'region_id' => 9,
                    'name' => 'SAME',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            48 =>
                array (
                    'id' => 49,
                    'region_id' => 9,
                    'name' => 'SIHA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            49 =>
                array (
                    'id' => 50,
                    'region_id' => 10,
                    'name' => 'KILWA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            50 =>
                array (
                    'id' => 51,
                    'region_id' => 10,
                    'name' => 'LINDI MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            51 =>
                array (
                    'id' => 52,
                    'region_id' => 10,
                    'name' => 'LIWALE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            52 =>
                array (
                    'id' => 53,
                    'region_id' => 10,
                    'name' => 'NACHINGWEA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            53 =>
                array (
                    'id' => 54,
                    'region_id' => 10,
                    'name' => 'RUANGWA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            54 =>
                array (
                    'id' => 55,
                    'region_id' => 11,
                    'name' => 'BABATI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            55 =>
                array (
                    'id' => 56,
                    'region_id' => 11,
                    'name' => 'HANANG',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            56 =>
                array (
                    'id' => 57,
                    'region_id' => 11,
                    'name' => 'KITETO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            57 =>
                array (
                    'id' => 58,
                    'region_id' => 11,
                    'name' => 'MBULU',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            58 =>
                array (
                    'id' => 59,
                    'region_id' => 11,
                    'name' => 'SIMANJIRO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            59 =>
                array (
                    'id' => 60,
                    'region_id' => 12,
                    'name' => 'BUNDA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            60 =>
                array (
                    'id' => 61,
                    'region_id' => 12,
                    'name' => 'BUTIAMA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            61 =>
                array (
                    'id' => 62,
                    'region_id' => 12,
                    'name' => 'MUSOMA MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            62 =>
                array (
                    'id' => 63,
                    'region_id' => 12,
                    'name' => 'RORYA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            63 =>
                array (
                    'id' => 64,
                    'region_id' => 12,
                    'name' => 'SERENGETI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            64 =>
                array (
                    'id' => 65,
                    'region_id' => 12,
                    'name' => 'TARIME',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            65 =>
                array (
                    'id' => 66,
                    'region_id' => 13,
                    'name' => 'OTHERS',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            66 =>
                array (
                    'id' => 67,
                    'region_id' => 13,
                    'name' => 'CHUNYA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            67 =>
                array (
                    'id' => 68,
                    'region_id' => 13,
                    'name' => 'KYELA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            68 =>
                array (
                    'id' => 69,
                    'region_id' => 13,
                    'name' => 'MBARALI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            69 =>
                array (
                    'id' => 70,
                    'region_id' => 13,
                    'name' => 'MBEYA MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            70 =>
                array (
                    'id' => 71,
                    'region_id' => 24,
                    'name' => 'MBOZI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            71 =>
                array (
                    'id' => 72,
                    'region_id' => 13,
                    'name' => 'RUNGWE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            72 =>
                array (
                    'id' => 74,
                    'region_id' => 14,
                    'name' => 'GAIRO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            73 =>
                array (
                    'id' => 75,
                    'region_id' => 14,
                    'name' => 'KILOMBERO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            74 =>
                array (
                    'id' => 76,
                    'region_id' => 14,
                    'name' => 'KILOSA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            75 =>
                array (
                    'id' => 77,
                    'region_id' => 14,
                    'name' => 'MOROGORO MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            76 =>
                array (
                    'id' => 78,
                    'region_id' => 14,
                    'name' => 'MVOMERO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            77 =>
                array (
                    'id' => 79,
                    'region_id' => 14,
                    'name' => 'ULANGA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            78 =>
                array (
                    'id' => 80,
                    'region_id' => 15,
                    'name' => 'MASASI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            79 =>
                array (
                    'id' => 81,
                    'region_id' => 15,
                    'name' => 'MASASI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            80 =>
                array (
                    'id' => 82,
                    'region_id' => 15,
                    'name' => 'NEWALA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            81 =>
                array (
                    'id' => 83,
                    'region_id' => 15,
                    'name' => 'NANYUMBU',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            82 =>
                array (
                    'id' => 84,
                    'region_id' => 15,
                    'name' => 'NEWALA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            83 =>
                array (
                    'id' => 85,
                    'region_id' => 15,
                    'name' => 'TANDAHIMBA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            84 =>
                array (
                    'id' => 86,
                    'region_id' => 16,
                    'name' => 'ILEMELA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            85 =>
                array (
                    'id' => 87,
                    'region_id' => 16,
                    'name' => 'KWIMBA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            86 =>
                array (
                    'id' => 88,
                    'region_id' => 16,
                    'name' => 'MAGU',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            87 =>
                array (
                    'id' => 89,
                    'region_id' => 16,
                    'name' => 'MISUNGWI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            88 =>
                array (
                    'id' => 90,
                    'region_id' => 16,
                    'name' => 'NYAMAGANA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            89 =>
                array (
                    'id' => 91,
                    'region_id' => 16,
                    'name' => 'SENGEREMA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            90 =>
                array (
                    'id' => 92,
                    'region_id' => 16,
                    'name' => 'UKEREWE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            91 =>
                array (
                    'id' => 93,
                    'region_id' => 17,
                    'name' => 'LUDEWA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            92 =>
                array (
                    'id' => 94,
                    'region_id' => 17,
                    'name' => 'IRINGA VIJIJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            93 =>
                array (
                    'id' => 95,
                    'region_id' => 17,
                    'name' => 'MAKETE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            94 =>
                array (
                    'id' => 96,
                    'region_id' => 17,
                    'name' => 'NJOMBE MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            95 =>
                array (
                    'id' => 97,
                    'region_id' => 17,
                    'name' => 'WANGING\'OMBE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            96 =>
                array (
                    'id' => 98,
                    'region_id' => 29,
                    'name' => 'MICHEWENI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            97 =>
                array (
                    'id' => 99,
                    'region_id' => 29,
                    'name' => 'WETE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            98 =>
                array (
                    'id' => 100,
                    'region_id' => 30,
                    'name' => 'CHAKE CHAKE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            99 =>
                array (
                    'id' => 101,
                    'region_id' => 30,
                    'name' => 'MKOANI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            100 =>
                array (
                    'id' => 102,
                    'region_id' => 18,
                    'name' => 'BAGAMOYO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            101 =>
                array (
                    'id' => 103,
                    'region_id' => 18,
                    'name' => 'KIBAHA MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            102 =>
                array (
                    'id' => 104,
                    'region_id' => 18,
                    'name' => 'KISARAWE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            103 =>
                array (
                    'id' => 105,
                    'region_id' => 18,
                    'name' => 'MAFIA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            104 =>
                array (
                    'id' => 106,
                    'region_id' => 18,
                    'name' => 'MKURANGA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            105 =>
                array (
                    'id' => 107,
                    'region_id' => 18,
                    'name' => 'RUFIJI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            106 =>
                array (
                    'id' => 108,
                    'region_id' => 19,
                    'name' => 'KALAMBO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            107 =>
                array (
                    'id' => 109,
                    'region_id' => 19,
                    'name' => 'NKASI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            108 =>
                array (
                    'id' => 110,
                    'region_id' => 19,
                    'name' => 'SUMBAWANGA MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            109 =>
                array (
                    'id' => 111,
                    'region_id' => 20,
                    'name' => 'MBINGA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            110 =>
                array (
                    'id' => 112,
                    'region_id' => 20,
                    'name' => 'SONGEA MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            111 =>
                array (
                    'id' => 113,
                    'region_id' => 20,
                    'name' => 'TUNDURU',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            112 =>
                array (
                    'id' => 114,
                    'region_id' => 20,
                    'name' => 'NAMTUMBO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            113 =>
                array (
                    'id' => 115,
                    'region_id' => 20,
                    'name' => 'NYASA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            114 =>
                array (
                    'id' => 116,
                    'region_id' => 21,
                    'name' => 'KAHAMA MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            115 =>
                array (
                    'id' => 117,
                    'region_id' => 21,
                    'name' => 'KISHAPU',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            116 =>
                array (
                    'id' => 118,
                    'region_id' => 21,
                    'name' => 'SHINYANGA MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            117 =>
                array (
                    'id' => 119,
                    'region_id' => 22,
                    'name' => 'BARIADI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            118 =>
                array (
                    'id' => 120,
                    'region_id' => 22,
                    'name' => 'BUSEGA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            119 =>
                array (
                    'id' => 121,
                    'region_id' => 22,
                    'name' => 'ITILIMA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            120 =>
                array (
                    'id' => 122,
                    'region_id' => 22,
                    'name' => 'MASWA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            121 =>
                array (
                    'id' => 123,
                    'region_id' => 22,
                    'name' => 'MEATU',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            122 =>
                array (
                    'id' => 124,
                    'region_id' => 23,
                    'name' => 'IKUNGI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            123 =>
                array (
                    'id' => 125,
                    'region_id' => 23,
                    'name' => 'IRAMBA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            124 =>
                array (
                    'id' => 126,
                    'region_id' => 23,
                    'name' => 'MANYONI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            125 =>
                array (
                    'id' => 127,
                    'region_id' => 23,
                    'name' => 'MKALAMA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            126 =>
                array (
                    'id' => 128,
                    'region_id' => 23,
                    'name' => 'SINGIDA MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            127 =>
                array (
                    'id' => 129,
                    'region_id' => 24,
                    'name' => 'MBEYA VIJIJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            128 =>
                array (
                    'id' => 130,
                    'region_id' => 25,
                    'name' => 'IGUNGA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            129 =>
                array (
                    'id' => 131,
                    'region_id' => 25,
                    'name' => 'KALIUA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            130 =>
                array (
                    'id' => 132,
                    'region_id' => 25,
                    'name' => 'NZEGA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            131 =>
                array (
                    'id' => 133,
                    'region_id' => 25,
                    'name' => 'SIKONGE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            132 =>
                array (
                    'id' => 134,
                    'region_id' => 25,
                    'name' => 'TABORA MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            133 =>
                array (
                    'id' => 135,
                    'region_id' => 25,
                    'name' => 'URAMBO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            134 =>
                array (
                    'id' => 136,
                    'region_id' => 25,
                    'name' => 'UYUI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            135 =>
                array (
                    'id' => 137,
                    'region_id' => 26,
                    'name' => 'HANDENI MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            136 =>
                array (
                    'id' => 138,
                    'region_id' => 26,
                    'name' => 'KILINDI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            137 =>
                array (
                    'id' => 139,
                    'region_id' => 26,
                    'name' => 'KOROGWE MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            138 =>
                array (
                    'id' => 140,
                    'region_id' => 26,
                    'name' => 'LUSHOTO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            139 =>
                array (
                    'id' => 141,
                    'region_id' => 26,
                    'name' => 'MUHEZA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            140 =>
                array (
                    'id' => 142,
                    'region_id' => 26,
                    'name' => 'MKINGA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            141 =>
                array (
                    'id' => 143,
                    'region_id' => 26,
                    'name' => 'PANGANI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            142 =>
                array (
                    'id' => 144,
                    'region_id' => 26,
                    'name' => 'TANGA MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            143 =>
                array (
                    'id' => 145,
                    'region_id' => 31,
                    'name' => 'UNGUJA MAGHARIBI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            144 =>
                array (
                    'id' => 146,
                    'region_id' => 31,
                    'name' => 'MJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            145 =>
                array (
                    'id' => 147,
                    'region_id' => 27,
                    'name' => 'KASKAZINI A',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            146 =>
                array (
                    'id' => 148,
                    'region_id' => 27,
                    'name' => 'KASKAZINI B',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            147 =>
                array (
                    'id' => 149,
                    'region_id' => 28,
                    'name' => 'KATI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            148 =>
                array (
                    'id' => 150,
                    'region_id' => 28,
                    'name' => 'KUSINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            149 =>
                array (
                    'id' => 151,
                    'region_id' => 13,
                    'name' => 'MBEYA VIJIJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            150 =>
                array (
                    'id' => 152,
                    'region_id' => 15,
                    'name' => 'MTWARA VIJIJINI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            151 =>
                array (
                    'id' => 153,
                    'region_id' => 24,
                    'name' => 'ILEJE',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            152 =>
                array (
                    'id' => 154,
                    'region_id' => 24,
                    'name' => 'MOMBA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
            153 =>
                array (
                    'id' => 155,
                    'region_id' => 32,
                    'name' => 'OTHERS',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ),
        ));
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

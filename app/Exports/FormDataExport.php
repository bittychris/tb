<?php

namespace App\Exports;

use App\Models\FormData;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class FormDataExport implements FromView, ShouldAutoSize
{
    public function view() : view
    {
        $res = FormData::join('age_groups', 'age_groups.id', '=', 'age_group_id')
                ->groupBy('attribute_id', 'age_group_id')
                ->select(
                    'attribute_id',
                    'age_group_id',
                    DB::raw('SUM(male) as male'),
                    DB::raw('SUM(female) as female')
                )
                ->orderBy('age_groups.min', 'asc')
                ->get();
            
        // $res =  FormData::groupBy(['attribute_id'])
        // ->select('attribute_id', 'age_group_id', 
        //     DB::raw('SUM(male) as male'), 
        //     DB::raw('SUM(female) as female')
        // )->orderBy(age_groups->min)
        // ->get(age->min);

        $formattedData = [];
        $x = 0;

        foreach ($res as $formData) {
            $x++;
            if ($x == 1) {
                // Add a new row for attribute information
                $formattedData[] = [
                    'attribute_name' => $formData['attribute']['name'],
                    'age' => 'Age',
                    'male' => 'Male',
                    'female' => 'Female',
                ];
            }
    
            // Add a new row for each formData
            $formattedData[] = [
                'attribute_name' => '',
                'age' => $formData['age_group']['slug'],
                'male' => $formData['male'],
                'female' => $formData['female'] ?: 0,
            ];
    
            if ($x == 3) {
                $x = 0;
            }
        }
       return view('exports.formDataAll', [
        'formDatas' =>  $res
       ]);
    }
}
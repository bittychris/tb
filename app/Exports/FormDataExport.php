<?php

namespace App\Exports;

use App\Models\FormData;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class FormDataExport implements FromView, ShouldAutoSize
{   
    protected $range;
    public function __construct($range)
    {
        $this->range= $range;
    }
    public function view() : view
    {
        $range = explode(',', $this->range);
        $res =  FormData::groupBy(['attribute_id', 'age_group_id'])
        ->select('attribute_id', 'age_group_id', 
            DB::raw('SUM(male) as male'), 
            DB::raw('SUM(female) as female')
        )->whereBetween('created_at', $range)
        ->get();

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
    
            if ($x == 2) {
                $x = 0;
            }
        }
       return view('exports.formDataAll', [
        'formDatas' =>  $res
       ]);
    }
}

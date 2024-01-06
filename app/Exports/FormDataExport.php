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
        
        $res =  FormData::groupBy(['attribute_id', 'age_group_id'])
        ->select('attribute_id', 'age_group_id', 
            DB::raw('SUM(male) as male'), 
            DB::raw('SUM(female) as female')
        )
        ->get();
        // $res = $res->groupBy('attribute_id')->map(function ($group) {
        //     $male = $group->sum('male');
        //     $female = $group->sum('female');

        //     return $group->sortBy('age_group.min')->unique('age_group.min')->sum('male')->sum('female');
        // });
       return view('exports.formDataAll', [
        'formDatas' =>  $res
       ]);
    }
}

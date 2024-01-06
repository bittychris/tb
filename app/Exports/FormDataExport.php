<?php

namespace App\Exports;

use App\Models\FormData;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FormDataExport implements FromView, ShouldAutoSize
{
    public function view() : view
    {
        $user = Auth::user();
        $res =  $user->forms;
        $res = $res->groupBy(['attribute_id'])->map(function ($group) {
            return $group->sortBy('age_group.min')->unique('age_group.min')->sum('male')->sum('female');
        });
       return view('exports.formData', [
        'formDatas' =>  $res,
       ]);
    }
}

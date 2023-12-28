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
        $res =  FormData::all();
        
       return view('exports.formData', [
        'formDatas' =>  $res
       ]);
    }
}

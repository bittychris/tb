<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\FormData;

class FormDataOneExport implements FromView, ShouldAutoSize
{
    protected $data;
    
    
    public function __construct($data)
    {
        $this->data = $data;
        // dd($data);
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : view
    {   
        
        $res =  FormData::where('form_id', $this->data)->get();
        $res = $res->groupBy('attribute_id')->map(function ($group) {
            return $group->sortBy('age_group.min')->unique('age_group.min');
        });
        
       return view('exports.formData', [
        'formDatas' =>  $res
       ]);
    }
}

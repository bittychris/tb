<?php

namespace App\Exports;

use App\Models\Form;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FormController;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FormExport implements FromView, ShouldAutoSize
{
    
    public function view() : view
    {
        $user = Auth::user();
        $res =  $userforms;
       return view('exports.form', [
        'forms' =>  $res
       ]);
    }
}

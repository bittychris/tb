<?php

namespace App\Exports;

use App\Models\Form;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FormController;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Auth;

class FormExport implements FromView, ShouldAutoSize
{
    
    public function view() : view
    {
        $user = Auth::user();
        $userforms = $user->forms;
        $res =  $userforms;
       return view('exports.form', [
        'forms' =>  $res
       ]);
    }
}

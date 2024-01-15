<?php

namespace App\Exports;

use App\Models\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FormController;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

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
<?php

namespace App\Exports;

use App\Models\Form;
use App\Models\User;
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
        $users = User::all();
       return view('exports.form', [
        'forms' =>  $res,
        'users' => $users
       ]);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Exports\FormDataExport;
use App\Exports\FormAttributeExport;
use App\Models\FormData;
use App\Models\FormAttribute;

class ExportController extends Controller
{
    public function export()
    {
        $user = User::all();
        return Excel::download(new UsersExport($user), 'users.xlsx');
    }
    public function formdata()
    {
        $form = FormData::all();
        return Excel::download(new FormDataExport($form), 'formdata.xlsx');
    }
    public function formattribute()
    {
        $formdata = FormAttribute::all();
        return Excel::download(new FormAttributeExport($formdata), 'formattributedata.xlsx');
    }
    
}

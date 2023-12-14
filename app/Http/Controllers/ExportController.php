<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Exports\FormDataExport;
use App\Models\FormData;

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
}

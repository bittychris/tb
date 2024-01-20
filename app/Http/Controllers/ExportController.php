<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Exports\FormExport;
use App\Exports\FormDataExport;
use App\Exports\FormDataOneExport;
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
        return Excel::download(new FormDataExport(), 'formdata.xlsx');
    }
    public function formOne($formdata)
    {
        return Excel::download(new FormDataOneExport($formdata), 'formdata.xlsx');
    }
    public function formattribute()
    {
        $formdata = FormAttribute::all();
        return Excel::download(new FormAttributeExport($formdata), 'formattributedata.xlsx');
    }

    public function form()
    {
        return Excel::download(new FormExport, 'form.xlsx');
    }
   
        
    public function testExport(){

        return Excel::download(new TBReportExport, 'tb_report.xlsx');

    }
}
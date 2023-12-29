<?php

namespace App\Http\Controllers\Reports;
use App\Models\Form;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function form()
    {
        $res =  Form::all();
        return view('admin_report.report', [
            'forms' => $res
        ]);
    }
}

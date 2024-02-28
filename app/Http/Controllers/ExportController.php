<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use App\Models\FormData;
use App\Exports\FormExport;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Models\FormAttribute;
use App\Exports\FormDataExport;
use App\Exports\FieldDataExport;
use App\Exports\FormDataOneExport;
use App\Exports\FormAttributeExport;
use App\Exports\RegionalReportExport;
use App\Exports\SingleFormDataExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
        $user = User::all();
        return Excel::download(new UsersExport($user), 'users.xlsx');
    }
    public function formdata($range)
    {
        $time = now()->toDateTimeString();

        return Excel::download(new FormDataExport($range), 'form_data-'.$time.'.xlsx');
    }
    public function formOne($formdata)
    {
        $time = now()->toDateTimeString();

        return Excel::download(new FormDataOneExport($formdata), 'single-form-'.$time.'.xlsx');
    }

    public function formattribute()
    {
        $formdata = FormAttribute::all();
        return Excel::download(new FormAttributeExport($formdata), 'formattributedata.xlsx',[
            'beforeSheet' => function (\Maatwebsite\Excel\Writer $writer) {
                $writer->getActiveSheet()->getColumnDimension('A')->setWidth(35); // Set width for column A
                $writer->getActiveSheet()->getColumnDimension('B')->setWidth(35); // Set width for column B

            },
        ]);
    }

    public function form($keywords, $startDate, $endDate)
    {
        $time = now()->toDateTimeString();

        return Excel::download(new FormExport($keywords, $startDate, $endDate), 'form-'.$time.'.xlsx');
    }

    public function fieldData($keywords, $submission_status, $startDate, $endDate)
    {
        $time = now()->toDateTimeString();

        return Excel::download(new FieldDataExport($keywords, $submission_status, $startDate, $endDate), 'field-data-'.$time.'.xlsx');
    }

    public function singleFormData($form_id)
    {
        // $formdata = Form::findOrFail($formdata);
        $time = now()->toDateTimeString();

        return Excel::download(new SingleFormDataExport($form_id), 'field-data-'.$time.'.xlsx');
    }

    public function reginalReport($region_id, $startDate, $endDate)
    {
        $time = now()->toDateTimeString();

        return Excel::download(new RegionalReportExport($region_id, $startDate, $endDate), 'reginal-report-'.$time.'.xlsx');
    }
}
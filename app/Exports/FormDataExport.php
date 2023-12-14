<?php

namespace App\Exports;

use App\Models\FormData;
use Maatwebsite\Excel\Concerns\FromCollection;

class FormDataExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FormData::all();
    }
}

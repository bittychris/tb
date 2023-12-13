<?php

namespace App\Exports;

use App\Models\FormAttribute;
use Maatwebsite\Excel\Concerns\FromCollection;

class FormAttributeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FormAttribute::all();
    }
}

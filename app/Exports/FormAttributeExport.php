<?php

namespace App\Exports;

use App\Models\FormAttribute;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FormAttributeExport implements FromArray
{
    protected $data;
   
    public function __construct($data)
    {
        $this->data = $data;
    }
   
    public function headings(): array
    {
        return [
            'Fields',
            'Day visited',
        ];
    }
   
    public function array(): array
    {
        return $this->data->toArray();
    }
}
<?php

namespace App\Exports;

use App\Models\FormAttribute;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FormAttributeExport implements FromArray, WithHeadings, ShouldAutoSize
{
    protected $data;
   
    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * @return array
     */
   
    public function headings(): array
    {
        $headings = [];
        foreach($this->data->toArray()[0] as $key => $value){
            $headings[] = FormAttribute::HEADINGS[$key];
        }

        return $headings;
    }


    public function array(): array
    {
        return $this->data->toArray();
    }


    

}
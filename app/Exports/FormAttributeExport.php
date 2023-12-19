<?php

namespace App\Exports;

use App\Models\FormAttribute;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FormAttributeExport implements FromArray,WithHeadings, WithColumnFormatting, WithMapping, ShouldAutoSize
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

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'C' => NumberFormat::FORMAT_CURRENCY_EUR_INTEGER,
        ];
    }
   
    public function array(): array
    {
        return $this->data->toArray();
    }

    public function prepareRows($rows)
    {
        return $rows->transform(function ($user) {
            $user->name .= ' (prepared)';

            return $user;
        });
    }
    /**
     * @param  RowType  $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->name,
            Date::dateTimeToExcel($row->created_at)
        ];
    }

}
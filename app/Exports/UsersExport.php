<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromArray, WithHeadings, ShouldAutoSize
{   
    protected $data;
   
    public function __construct($data)
    {
        $this->data = $data;
    }
    // public function collection()
    // {
    //     return User::all();
    // }
    public function headings(): array
    {
        return [
            'sn',
            'first name',
            'last name',
            'Email',
            'Phone Number'
        ];
    }
   
    public function array(): array
    {
        return $this->data->toArray();
    }

}

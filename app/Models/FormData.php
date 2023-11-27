<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends BaseModal
{
    use HasFactory;

    protected $table = 'form_data';

    protected $fillable = [
        'form_id',
        'age_group_id',
        'attribute_id',
        'male',
        'female'
    ];
}

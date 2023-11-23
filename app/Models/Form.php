<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends BaseModal
{
    use HasFactory;

    protected $table = 'forms';

    protected $fillable = [
        'form_attribute_id',
        'scanning_name',
        'ward_id',
        'address',
        'created_by',
        'completed_by'
    ];
    
}

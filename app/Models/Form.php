<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $table='forms';

    protected $fillable=[
        'form_attribute_id',
        'scaning_name',
        'ward_id',
        'address',
        'createdBy',
        'completedBy'

    ];
    
}

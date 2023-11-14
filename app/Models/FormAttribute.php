<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormAttribute extends Model
{
    use HasFactory;

    protected $table= 'form_attributes';

    protected $fillable=[
        'name',
        'age_group_ids',
        'attribute_ids'
    ];
}

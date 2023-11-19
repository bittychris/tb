<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormAttribute extends BaseModal
{
    use HasFactory;

    protected $table = 'form_attributes';

    protected $fillable = [
        'name',
        'age_groups_ids',
        'attribute_ids'
    ];

}

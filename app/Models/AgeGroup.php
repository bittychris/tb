<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeGroup extends BaseModal
{
    use HasFactory;

    protected $table = 'age_groups';

    protected $fillable = [
        'slug',
        'min',
        'max'
    ];

}

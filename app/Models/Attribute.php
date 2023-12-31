<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends BaseModal
{
    use HasFactory;

    protected $table = 'attributes';

    protected $fillable = [
        'name'
    ];
    
}

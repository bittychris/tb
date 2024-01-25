<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'form_id',
        'as_personnel_id',
        'content',
        'read_at',
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormAttribute extends BaseModal
{
    use HasFactory;

    protected $table = 'form_attributes';

    const HEADINGS = [
        'name' => 'Name',
        'created_at' => 'Visited at'
    ];

    protected $fillable = [
        'name',
        'age_group_ids',
        'attribute_ids'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $hidden = [
        'id',
        'age_group_ids',
        'attribute_ids',
        'updated_at'
    ];

}

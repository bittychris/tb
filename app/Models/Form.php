<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'ward_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }
    

    public function added_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function form_attribute(): BelongsTo
    {
        return $this->belongsTo(FormAttribute::class, 'form_attribute_id');
    }
    
    // public function form_data(): BelongsTo
    // {
    //     return $this->belongsTo(FormData::class, 'form_id');
    // }
    
}
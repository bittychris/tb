<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class District extends Model
{
    use HasFactory;

    public function form()
    {
        return $this->hasOne(Form::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
    public function wards()
    {
        return $this->hasMany(Ward::class, 'ward_id', 'id');
    }
}

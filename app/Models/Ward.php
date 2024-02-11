<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ward extends Model
{
    use HasFactory;

    protected $table = 'wards';

    protected $fillable = [
        'name',
        'district_id'
    ];
    
    public function form()
    {
        return $this->hasOne(Form::class);
    }
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
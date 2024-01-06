<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormData extends BaseModal
{
    use HasFactory;

    protected $table = 'form_data';

    protected $fillable = [
        'form_id',
        'age_group_id',
        'attribute_id',
        'male',
        'female'
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class, 'form_id');
    }

    public function age_group(): BelongsTo
    {
        return $this->belongsTo(AgeGroup::class, 'age_group_id');
    }

    public function attribute():belongsTo
    {
        return $this->belongsTo(Attribute::class);
    }
    
    public static function getGroupedData()
    {
        return self::with('id', 'form','age_group', 'attribute')
            ->groupBy('attribute_id');
    }
}

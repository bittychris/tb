<?php

namespace App\Models;

use App\Models\User;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class comments extends Model
{
    use HasFactory, Uuids;

    protected $table = 'comments';

    protected $fillable = [
        'form_id',
        'sender_id',
        'receiver_id',
        'content',
        'read_at',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class, 'form_id');
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // public function receiver(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'receiver_id');
    // }

    public function replies()
    {
        return $this->hasMany(comments::class, '_id');

    }
}
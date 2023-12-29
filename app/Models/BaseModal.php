<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class BaseModal extends Model
{
    use Uuids;
    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    protected $fillable = [
        'file',
        'alt',
        'caption',
        'is_teaser',
        'sort_order',
    ];

    protected $casts = [
        'is_teaser' => 'boolean',
    ];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}

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
        'width',
        'height',
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

    public function getOrientationAttribute(): string
    {
        if (!$this->width || !$this->height) {
            return 'unknown';
        }
        if ($this->width > $this->height) {
            return 'landscape';
        }
        if ($this->height > $this->width) {
            return 'portrait';
        }
        return 'square';
    }
}

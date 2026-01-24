<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'publish',
    ];

    protected $casts = [
        'publish' => 'boolean',
    ];

    public function attributes(): HasMany
    {
        return $this->hasMany(ProjectAttribute::class)->orderBy('sort_order');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable')->orderBy('sort_order');
    }

    public function teaser(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable')->where('is_teaser', true);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function statuses(): BelongsToMany
    {
        return $this->belongsToMany(Status::class);
    }

    public function scopePublished($query)
    {
        return $query->where('publish', true);
    }
}

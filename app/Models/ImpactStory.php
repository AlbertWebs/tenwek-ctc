<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpactStory extends Model
{
    protected $fillable = [
        'title', 'story', 'image', 'story_date', 'sort_order', 'is_visible',
    ];

    protected $casts = [
        'story_date' => 'date',
        'is_visible' => 'boolean',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('story_date', 'desc');
    }
}

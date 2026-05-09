<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\PublicAssetUrl;

class ImpactStory extends Model
{
    protected $fillable = [
        'title',
        'story',
        'image', // legacy URL field
        'image_path',
        'media_url',
        'story_date',
        'sort_order',
        'is_visible',
        'is_featured',
    ];

    protected $casts = [
        'story_date' => 'date',
        'is_visible' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('story_date', 'desc');
    }

    public function getImageUrlAttribute(): ?string
    {
        // Prefer uploaded image_path, fall back to legacy image URL.
        if (!empty($this->image_path)) {
            return PublicAssetUrl::toUrl($this->image_path);
        }

        return $this->image ?: null;
    }
}

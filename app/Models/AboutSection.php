<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\PublicAssetUrl;

class AboutSection extends Model
{
    protected $fillable = [
        'key',
        'title',
        'content',
        'featured_image_path',
        'media_url',
        'sort_order',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        return PublicAssetUrl::toUrl($this->featured_image_path);
    }
}

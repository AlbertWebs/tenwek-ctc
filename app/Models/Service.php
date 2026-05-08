<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\PublicAssetUrl;

class Service extends Model
{
    public const CATEGORY_CARDIAC = 'cardiac_surgery';
    public const CATEGORY_THORACIC = 'thoracic_surgery';
    public const CATEGORY_DIAGNOSTICS = 'diagnostics';

    protected $fillable = [
        'category',
        'name',
        'description',
        'featured_image_path',
        'slug',
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
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function scopeInCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        return PublicAssetUrl::toUrl($this->featured_image_path);
    }
}

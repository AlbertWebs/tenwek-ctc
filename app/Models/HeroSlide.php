<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Support\PublicAssetUrl;

class HeroSlide extends Model
{
    protected $fillable = [
        'image_path',
        'title',
        'subtitle',
        'cta_label',
        'cta_url',
        'sort_order',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'bool',
        'sort_order' => 'int',
    ];

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderByDesc('id');
    }

    public function getImageUrlAttribute(): string
    {
        return PublicAssetUrl::toUrl($this->image_path) ?? '';
    }
}


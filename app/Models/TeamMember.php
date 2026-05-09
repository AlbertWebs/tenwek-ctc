<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\PublicAssetUrl;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'title',
        'specialization',
        'bio',
        'photo',
        'sort_order',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function getPhotoUrlAttribute(): ?string
    {
        return PublicAssetUrl::toUrl($this->photo);
    }

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

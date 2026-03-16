<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public const CATEGORY_CARDIAC = 'cardiac_surgery';
    public const CATEGORY_THORACIC = 'thoracic_surgery';
    public const CATEGORY_DIAGNOSTICS = 'diagnostics';

    protected $fillable = [
        'category',
        'name',
        'description',
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
}

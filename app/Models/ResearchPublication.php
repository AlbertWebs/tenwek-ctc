<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResearchPublication extends Model
{
    protected $fillable = [
        'title', 'authors', 'journal', 'year', 'url', 'abstract', 'sort_order', 'is_visible',
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
        return $query->orderBy('sort_order')->orderBy('year', 'desc');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryMilestone extends Model
{
    protected $fillable = [
        'year',
        'title',
        'description',
        'sort_order',
        'is_visible',
    ];

    protected $casts = [
        'year' => 'int',
        'sort_order' => 'int',
        'is_visible' => 'bool',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('year')->orderByDesc('id');
    }
}


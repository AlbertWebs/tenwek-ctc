<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientInfoBlock extends Model
{
    protected $fillable = [
        'key', 'title', 'content', 'sort_order', 'is_visible',
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
}

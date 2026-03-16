<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'donor_name', 'email', 'amount', 'currency', 'campaign', 'payment_method', 'donated_at', 'notes',
    ];

    protected $casts = [
        'donated_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('donated_at', now()->month)->whereYear('donated_at', now()->year);
    }
}

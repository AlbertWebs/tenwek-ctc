<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactEnquiry extends Model
{
    protected $fillable = [
        'name', 'email', 'subject', 'message', 'source', 'status',
    ];

    public const STATUS_NEW = 'new';
    public const STATUS_READ = 'read';
    public const STATUS_REPLIED = 'replied';
    public const STATUS_ARCHIVED = 'archived';

    public function scopeNew($query)
    {
        return $query->where('status', self::STATUS_NEW);
    }
}

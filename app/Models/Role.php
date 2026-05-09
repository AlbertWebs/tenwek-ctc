<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    public const SLUG_SUPER_ADMIN = 'super_admin';

    public const SLUG_EDITOR = 'editor';

    protected $fillable = ['name', 'slug', 'description'];

    /** Roles that may sign in to the admin dashboard (see {@see User::isAdmin()}). */
    public static function adminDashboardSlugs(): array
    {
        return [self::SLUG_SUPER_ADMIN, self::SLUG_EDITOR];
    }

    public function scopeForAdminDashboard(Builder $query): Builder
    {
        return $query->whereIn('slug', self::adminDashboardSlugs());
    }

    public function isAdminEligible(): bool
    {
        return in_array($this->slug, self::adminDashboardSlugs(), true);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_role')->withTimestamps();
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function hasPermission(string $slug): bool
    {
        return $this->permissions()->where('slug', $slug)->exists();
    }
}

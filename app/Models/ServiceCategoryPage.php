<?php

namespace App\Models;

use App\Support\PublicAssetUrl;
use Illuminate\Database\Eloquent\Model;

class ServiceCategoryPage extends Model
{
    protected $fillable = [
        'url_segment',
        'admin_label',
        'meta_title',
        'meta_description',
        'intro_kicker',
        'intro_heading',
        'intro_subheading',
        'body_html',
        'featured_image_path',
    ];

    public function getRouteKeyName(): string
    {
        return 'url_segment';
    }

    public function featuredImageUrl(): ?string
    {
        return PublicAssetUrl::toUrl($this->featured_image_path);
    }
}

<?php

use App\Models\SiteSetting;
use App\Support\LegalPageContent;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        foreach (LegalPageContent::defaults() as $key => $html) {
            if (! SiteSetting::query()->where('key', $key)->exists()) {
                SiteSetting::setValue($key, $html);
            }
        }
    }

    public function down(): void
    {
        foreach (array_keys(LegalPageContent::defaults()) as $key) {
            SiteSetting::query()->where('key', $key)->delete();
            \Illuminate\Support\Facades\Cache::forget('site_setting:'.$key);
        }
    }
};

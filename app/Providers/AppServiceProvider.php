<?php

namespace App\Providers;

use App\Models\AboutSection;
use App\Models\ImpactStory;
use App\Models\NewsArticle;
use App\Models\PatientInfoBlock;
use App\Models\ResearchPublication;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::bind('news', fn (string $value) => NewsArticle::findOrFail($value));
        Route::bind('about_section', fn (string $value) => AboutSection::findOrFail($value));
        Route::bind('patient_info_block', fn (string $value) => PatientInfoBlock::findOrFail($value));
        Route::bind('patient_info', fn (string $value) => PatientInfoBlock::findOrFail($value));
        Route::bind('research_publication', fn (string $value) => ResearchPublication::findOrFail($value));
        Route::bind('impact_story', fn (string $value) => ImpactStory::findOrFail($value));
    }
}

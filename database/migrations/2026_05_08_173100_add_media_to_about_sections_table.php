<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_sections', function (Blueprint $table) {
            $table->string('featured_image_path')->nullable()->after('content');
            $table->string('media_url')->nullable()->after('featured_image_path'); // YouTube/Vimeo/etc
        });
    }

    public function down(): void
    {
        Schema::table('about_sections', function (Blueprint $table) {
            $table->dropColumn(['featured_image_path', 'media_url']);
        });
    }
};


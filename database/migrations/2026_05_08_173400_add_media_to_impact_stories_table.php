<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('impact_stories', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('image');
            $table->string('media_url')->nullable()->after('image_path'); // YouTube/Vimeo/etc
        });
    }

    public function down(): void
    {
        Schema::table('impact_stories', function (Blueprint $table) {
            $table->dropColumn(['image_path', 'media_url']);
        });
    }
};

